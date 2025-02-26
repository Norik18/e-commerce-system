<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mostrar todos los pedidos (ejemplo, se pueden filtrar por usuario)
        $pedidos = Pedidos::where('id_usuario', Auth::id())->get();
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar el formulario para crear un nuevo pedido
        return view('pedidos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'total' => 'required|numeric',
            'id_estado_pedido' => 'required|integer',
            // Otros campos que necesiten validación
        ]);

        // Crear un nuevo pedido, con el ID del usuario autenticado
        $pedido = Pedidos::create([
            'id_usuario' => Auth::id(),  // Asignar el usuario autenticado
            'id_estado_pedido' => $request->input('id_estado_pedido'),
            'fecha_pedido' => now(),
            'total' => $request->input('total'),
        ]);

        // Redirigir o mostrar mensaje de éxito
        return redirect()->route('pedidos.index')->with('success', 'Pedido creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedidos $pedido)
    {
        // Mostrar los detalles de un pedido específico
        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedidos $pedido)
    {
        // Mostrar el formulario para editar un pedido específico
        return view('pedidos.edit', compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedidos $pedido)
    {
        // Validación de los datos de actualización
        $request->validate([
            'total' => 'required|numeric',
            'id_estado_pedido' => 'required|integer',
            // Otros campos que necesiten validación
        ]);

        // Actualizar los datos del pedido
        $pedido->update([
            'id_estado_pedido' => $request->input('id_estado_pedido'),
            'total' => $request->input('total'),
            // Otros campos que necesiten ser actualizados
        ]);

        // Redirigir o mostrar mensaje de éxito
        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedidos $pedido)
    {
        // Eliminar un pedido
        $pedido->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado con éxito');
    }
}
