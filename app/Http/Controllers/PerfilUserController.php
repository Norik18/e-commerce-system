<?php

namespace App\Http\Controllers;

use App\Models\PerfilUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuario = session('usuario'); // Obtener datos del usuario desde la sesión
        $idUsuario = $usuario['id_usuario'];
    
        // Contar los productos asociados al usuario logueado
        $cantidadProductos = DB::table('productos')->where('id_usuario', $idUsuario)->count();
        
        $tipos_usuarios = DB::table('tipo_usuarios')->select('id_tipo_usuario', 'tipo_usuario')->get();
        return view('usuarios/funciones-usuario/perfil', compact('tipos_usuarios', 'cantidadProductos'));
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
    public function show(PerfilUser $perfilUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerfilUser $perfilUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerfilUser $perfilUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerfilUser $perfilUser)
    {
        //
    }
}
