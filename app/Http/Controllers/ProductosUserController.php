<?php

namespace App\Http\Controllers;

use App\Models\ProductosUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Recupera los datos del usuario autenticado desde la sesión
        $usuario = $request->session()->get('usuario');
        $categorias = DB::table('categorias')->select('id_categoria', 'categoria')->get();

        if (!$usuario || !isset($usuario['id_usuario'])) {
            return redirect()->route('login.index')->withErrors(['error' => 'Debes iniciar sesión primero.']);
        }

        $id_usuario = $usuario['id_usuario'];

        $productos = DB::select('CALL sp_ProductosUsuario(?)', [$id_usuario]);
        return view('usuarios/funciones-usuario/productos-usuario', compact('productos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Valida los datos del formulario
        $request->validate([
            'nombre_producto' => 'required',
            'descripcion' => 'required',
            'stock' => 'required|numeric',
            'precio' => 'required',
            'imagen' => 'required|image',
            'id_categoria' => 'required|numeric',
        ]);

        try {
            // Obtener el id_usuario desde la sesión
            $id_usuario = session('usuario.id_usuario');  // Obtener el id del usuario logueado

            // Leer la imagen como binario
            $imageBinary = file_get_contents($request->file('imagen')->getRealPath());

            // Llamar al procedimiento almacenado para registrar el producto
            DB::statement('CALL sp_CrearProducto(?, ?, ?, ?, ?, ?, ?)', [
                $request->nombre_producto,
                $request->descripcion,
                $request->stock,
                $request->precio,
                $imageBinary,
                $request->id_categoria,
                $id_usuario
            ]);

            return redirect()->route("productos-user.index")->with('success', 'Producto creado exitosamente!');
        } catch (\Exception $e) {
            return redirect()->route("productos-user.index")->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductosUser $productosUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductosUser $productosUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductosUser $productosUser)
    {
        //
        $request->validate([
            'id_producto' => 'required|integer',
            'nombre_producto' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'stock' => 'required|integer',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|file|image',
            'id_categoria' => 'required|integer',
        ]);

        try {
            // Obtener el id_usuario desde la sesión
            $id_usuario = $request->session()->get('usuario.id_usuario');

            // Manejo de la imagen si se proporciona
            $imageBinary = null;
            if ($request->file('imagen')) {
                // Leer la imagen como binario
                $imageBinary = file_get_contents($request->file('imagen')->getRealPath());
            }

            // Llamar al procedimiento almacenado
            DB::statement('CALL sp_ActualizarProductoUsuario(?, ?, ?, ?, ?, ?, ?, ?)', [
                $request->post('id_producto'),
                $id_usuario,
                $request->post('nombre_producto'),
                $request->post('descripcion'),
                $request->post('stock'),
                $request->post('precio'),
                $imageBinary,
                $request->post('id_categoria'),
            ]);
            
            return redirect()->route('productos-usuario.index')->with('success', 'Producto actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('productos-usuario.index')->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductosUser $productosUser)
    {
        //
    }

    public function image($id)
    {
        $producto = DB::table('productos')->where('id_producto', $id)->first();

        if ($producto && $producto->imagen) {
            return response($producto->imagen)->header('Content-Type', 'image/jpeg');
        }

        return response('Imagen no encontrada', 404);
    }
}

