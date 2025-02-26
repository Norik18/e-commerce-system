<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('login');
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
    public function show(Request $request)
    {
        //
        $request->validate([
            'usuario' => 'required',
            'clave' => 'required',
        ]);
    
        try {
            // Llamar al procedimiento almacenado
            $datos = DB::select('CALL sp_IniciarSesion(?, ?)', [
                $request->post('usuario'),  
                $request->post('clave')
            ]);
    
            // Si todo está correcto, iniciar sesión
            if (!empty($datos)) {
                // Guardar datos del usuario en la sesión
                $request->session()->put('usuario', [
                    'id_usuario' => $datos[0]->v_id_usuario,
                    'username' => $datos[0]->v_username,
                    'password' => $datos[0]->v_password_almacenada,
                    'nombres' => $datos[0]->v_nombres,
                    'apellido_paterno' => $datos[0]->v_apellido_paterno,
                    'apellido_materno' => $datos[0]->v_apellido_materno,
                    'direccion' => $datos[0]->v_direccion,
                    'telefono' => $datos[0]->v_telefono,
                    'tipo_usuario' => $datos[0]->v_tipo_usuario,
                    'estado' => $datos[0]->estado
                ]);
                return redirect()->route("home.index");
            }
        } catch (\Exception $e) {
            // Manejo de errores 
            return redirect()->route("login.index")->with('error',  dd($e->getMessage()));
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Login $login)
    {
        //
    }

    public function logout(Request $request)
    {
        $request->session()->forget('usuario');
        return redirect()->route('home.index');
    }
}
