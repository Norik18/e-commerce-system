<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener todas las categorías
        $categorias = DB::table('categorias')->select('id_categoria', 'categoria')->get();

        // Obtener el id_categoria de la URL
        $categoriaId = $request->input('categoria');

        if ($categoriaId) {
            // Llamar al procedimiento almacenado para obtener productos de una categoría específica
            $productos = DB::select('CALL sp_CategoriaProductos(?)', [$categoriaId]);
        } else {
            // Si no se pasa ningún filtro de categoría, mostrar todos los productos
            $productos = DB::select('CALL sp_MostrarProducto()');  // Si tienes un procedimiento para mostrar todos los productos
        }

        // Pasar los productos y categorías a la vista
        return view('productos.productos', compact('productos', 'categorias'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            // Llamar al procedimiento almacenado para obtener el producto por ID
            $producto = DB::select('CALL sp_MostrarProductoPorId(?)', [$id]);

            // Obtener las categorías (sin cambios)
            $categorias = DB::table('categorias')->select('id_categoria', 'categoria')->get();

            // Verificar si el producto existe
            if (empty($producto)) {
                return redirect()->route('productos.index')->with('error', 'Producto no encontrado.');
            }

            // Pasar el producto a la vista detalleprod.blade.php
            return view('productos/producto.detalleproducto', [
                'producto' => $producto[0], // Selecciona el primer resultado del procedimiento
                'categorias' => $categorias
            ]);
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('productos.index')->with('error', 'Error al obtener el producto: ' . $e->getMessage());
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
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
