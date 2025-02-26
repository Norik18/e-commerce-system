<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si hay un usuario en la sesión
        if (!$request->session()->has('usuario')) {
            // Redirige al formulario de inicio de sesión si no está autenticado
            return redirect()->route('login.index')->with('error', 'Debes iniciar sesión para acceder.');
        }

        // Continúa con la solicitud si está autenticado
        return $next($request);
    }
}
