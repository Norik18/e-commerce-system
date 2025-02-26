<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = DB::select('CALL sp_MostrarUsuarios()');
        return view('usuarios/usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'ruc' => 'required|numeric',
            'nombre_empresa' => 'required|string|max:255',
            'telefono' => 'required|numeric',
        ]);

        try {
            // Obtener el id_usuario desde la sesión
            $id_usuario = $request->session()->get('usuario.id_usuario');

            // Validar si el usuario está logeado
            if (!$id_usuario) {
                return redirect()->route('login.index')->with('error', 'Debe iniciar sesión para registrarse como proveedor.');
            }

            // Llamar al procedimiento almacenado para agregar el proveedor
            DB::statement('CALL sp_CrearProveedor(?, ?, ?, ?)', [
                $id_usuario,
                $request->input('ruc'),
                $request->input('nombre_empresa'),
                $request->input('telefono'),
            ]);

            // Obtener el usuario actualizado desde la base de datos
            $usuarioActualizado = DB::table('usuarios')
                ->join('tipo_usuarios', 'usuarios.id_tipo_usuario', '=', 'tipo_usuarios.id_tipo_usuario')
                ->where('usuarios.id_usuario', $id_usuario)
                ->select('usuarios.*', 'tipo_usuarios.tipo_usuario as tipo_usuario')
                ->first();

            // Actualizar los datos en la sesión
            $request->session()->put('usuario', (array) $usuarioActualizado);

            return redirect()->route('perfil.index')->with('success', 'Proveedor registrado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|size:8',
            'nombres' => 'required|max:255',
            'apellido_paterno' => 'required|max:255',
            'apellido_materno' => 'required|max:255',
            'direccion' => 'required|max:255',
            'correo_electronico' => 'required|max:255|email',
            'telefono' => 'required|numeric',
            'username' => 'required|unique:usuarios,username|max:255',
            'password' => 'required|min:6',
        ]);

        try {
            DB::statement('CALL sp_CrearUsuario(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $request->dni,
                $request->nombres,
                $request->apellido_paterno,
                $request->apellido_materno,
                $request->direccion,
                $request->correo_electronico,
                $request->telefono,
                $request->username,
                $request->password,
            ]);

            return redirect()->route("login.index")->with('success', 'Usuario registrado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route("registro.index")->with('error', 'Error al registrar usuario: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuarios $usuarios)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'id_usuario' => 'required|integer',
            'dni' => 'required|size:8',
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'correo_electronico' => 'required|string|max:255',
            'telefono' => 'required|numeric',
            'username' => 'required|string|max:255|unique:usuarios,username,' . $request->post('id_usuario') . ',id_usuario',
            'password' => 'nullable|string|min:8'
        ]);

        try {
            // Llamada al procedimiento almacenado para actualizar el usuario
            DB::statement('CALL sp_ActualizarUsuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $request->post('id_usuario'),
                $request->post('dni'),
                $request->post('nombres'),
                $request->post('apellido_paterno'),
                $request->post('apellido_materno'),
                $request->post('direccion'),
                $request->post('correo_electronico'),
                $request->post('telefono'),
                $request->post('username'),
                $request->post('password')
            ]);

            // Redirecciona con un mensaje de éxito
            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('usuarios.index')
                ->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Llamada al procedimiento almacenado para eliminar el usuario
        DB::statement('CALL sp_EliminarUsuario(?)', array($request->post('dni')));
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}

