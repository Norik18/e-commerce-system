<?php

namespace App\Http\Controllers;

use App\Models\Envios;
use App\Models\Pedidos;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoProductosController extends Controller
{
    /**
     * Mostrar el carrito de compras.
     */
    public function index()
    {
        // Mostrar la vista del carrito de compras
        return view('productos/producto/carrito-compras/vista-carrito');
    }

    /**
     * Procesar la información del carrito y mostrar la vista de proceso de compra.
     */
    public function proceso_compra(Request $request)
    {
        // Guardar los productos del carrito en la tabla 'pedidos'
        $productos = json_decode($request->input('productos'), true); // Decodifica el JSON a un array
        $total = $request->input('total');

        // Crear un nuevo pedido
        $pedido = Pedidos::create([
            'id_usuario' => Auth::id(), // Usuario autenticado
            'id_estado_pedido' => 1,    // Estado inicial del pedido (1 = "En proceso")
            'fecha_pedido' => now(),
            'total' => $total,
        ]);

        // Guardar cada producto en el pedido (usualmente necesitarías una relación pivot para productos)
        foreach ($productos as $producto) {
            // Aquí usamos 'id' en lugar de 'id_producto'   
            $pedido->productos()->attach($producto['id'], ['cantidad' => $producto['cantidad']]);
        }

        // Verificar que el pedido se haya creado correctamente y redirigir con el ID correcto
        if ($pedido && $pedido->id) {
            return redirect()->route('proceso-entrega.index', ['id_pedido' => $pedido->id]);
        } else {
            return redirect()->back()->with('error', 'Error al procesar el pedido. Inténtalo de nuevo.');
        }
    }



    /**
     * Mostrar la vista del proceso de entrega.
     */
    public function proceso_entrega($id_pedido)
    {
        return view('productos/producto/carrito-compras/proceso-entrega', ['id_pedido' => $id_pedido]);
    }

    /**
     * Procesar los datos de entrega y pasar al proceso de pago.
     */
    public function guardar_envio(Request $request)
    {
        // Obtener el id_pedido desde el request
        $id_pedido = $request->input('id_pedido');

        // Verifica si el id_pedido existe
        if (!$id_pedido) {
            return redirect()->back()->with('error', 'El id del pedido no se ha recibido correctamente.');
        }

        // Crear el envío con los datos del formulario
        $envio = Envios::create([
            'id_pedido' => $id_pedido,  // Guardar el id del pedido
            'departamento' => $request->input('departamento'),
            'provincia' => $request->input('provincia'),
            'distrito' => $request->input('distrito'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'instrucciones' => $request->input('instrucciones'),
        ]);

        // Redirigir a la vista de proceso de pago
        return redirect()->route('proceso-pago.index', ['id_pedido' => $id_pedido]);
    }


    /**
     * Mostrar la vista de proceso de pago.
     */
    public function proceso_pago($id_pedido)
    {
        // Lógica del proceso de pago
        return view('productos/producto/carrito-compras/proceso-pago', ['id_pedido' => $id_pedido]);
    }


    /**
     * Confirmar el pago y finalizar el proceso.
     */
    public function confirmar_pago(Request $request)
    {
        $id_pedido = $request->input('id_pedido');

        // Actualizar el estado del pedido a "Pagado"
        $pedido = Pedidos::find($id_pedido);
        $pedido->update([
            'id_estado_pedido' => 2, // Estado "Pagado"
        ]);

        // Redirigir a la página de confirmación o agradecimiento
        return redirect()->route('confirmacion-pago.index');
    }

    public function realizar_compra(Request $request)
    {
        // Recuperar los productos y el total de la compra desde el formulario
        $productos = json_decode($request->input('productos'), true);
        $total = $request->input('total');

        // Configurar valores adicionales para la venta
        $tipo_comprobante = 'Boleta'; // Puedes modificar esto según sea necesario
        $igv = $total * 0.18; // Suponiendo un IGV del 18%
        $subtotal = $total - $igv;
        $estado = 'Pagado'; // Estado de la venta
        $id_metodo_pago = 1; // Ajustar según el método de pago seleccionado (ejemplo: Tarjeta)
        $id_usuario = session('usuario.id_usuario'); // Obtén el ID desde la sesión

        if (!$id_usuario) {
            return redirect()->back()->with('error', 'No se pudo obtener el usuario autenticado.');
        }

        \Log::info('Iniciando el proceso de realizar compra', [
            'productos' => $productos,
            'total' => $total,
            'tipo_comprobante' => $tipo_comprobante,
            'igv' => $igv,
            'subtotal' => $subtotal,
            'estado' => $estado,
            'id_usuario' => $id_usuario,
        ]);

        try {
            \DB::beginTransaction();

            // Llamar al procedimiento almacenado sp_CrearVenta
            \Log::info('Llamando a sp_CrearVenta');
            $result = \DB::select(
                'CALL sp_CrearVenta(?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $id_usuario,
                    now(), // Fecha actual
                    $tipo_comprobante,
                    $igv,
                    $subtotal,
                    $total,
                    $id_metodo_pago,
                    $estado,
                ]
            );

            // Recuperar el ID de la venta
            $id_venta = $result[0]->id_venta ?? null;

            if (!$id_venta) {
                throw new \Exception('No se pudo generar el ID de la venta.');
            }

            \Log::info('Venta creada con ID:', ['id_venta' => $id_venta]);

            // Registrar los detalles de la venta
            foreach ($productos as $producto) {
                $id_producto = $producto['id'];
                $cantidad = $producto['cantidad'];
                $precio_venta = $producto['precio'];
                $descuento = 0; // Ajustar según sea necesario

                \Log::info('Llamando a sp_CrearDetalleVenta', [
                    'id_venta' => $id_venta,
                    'id_producto' => $id_producto,
                    'cantidad' => $cantidad,
                    'precio_venta' => $precio_venta,
                    'descuento' => $descuento,
                ]);

                \DB::select(
                    'CALL sp_CrearDetalleVenta(?, ?, ?, ?, ?)',
                    [
                        $id_venta,
                        $id_producto,
                        $cantidad,
                        $precio_venta,
                        $descuento,
                    ]
                );

                // Reducir el stock del producto
                $productoModel = Productos::find($id_producto);
                if ($productoModel) {
                    $productoModel->stock -= $cantidad;
                    $productoModel->save();
                }
            }

            \DB::commit();

            // Limpiar el carrito de la sesión
            session()->forget('carrito');

            return redirect()->route('home.index')->with('success', 'Compra realizada con éxito.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Error al procesar la compra: ' . $e->getMessage());
        }
    }
}
