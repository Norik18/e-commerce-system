<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\InformesUser;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; 

class InformesUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las ventas
        $ventas = Ventas::all();
        return view('usuarios.funciones-usuario.informes', compact('ventas'));
    }

    public function generarPDF($tipo)
    {
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek(); // Lunes de la semana actual
        $startOfMonth = Carbon::now()->startOfMonth(); // Primer día del mes

        // Filtrar ventas según el tipo de informe (diario, semanal, mensual)
        switch ($tipo) {
            case 'diario':
                $ventas = Ventas::whereDate('fecha', $today)->get();
                break;

            case 'semanal':
                $ventas = Ventas::whereBetween('fecha', [$startOfWeek, $today])->get();
                break;

            case 'mensual':
                $ventas = Ventas::whereBetween('fecha', [$startOfMonth, $today])->get();
                break;

            default:
                $ventas = collect(); // Si el tipo no es válido, devolvemos una colección vacía
        }

        // Generar el PDF usando la vista blade para los informes
        $pdf = Pdf::loadView('usuarios.funciones-usuario.informes-pdf', compact('ventas', 'tipo'));
        return $pdf->download('informe_ventas_' . $tipo . '.pdf');
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
    public function show(InformesUser $informesUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InformesUser $informesUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InformesUser $informesUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformesUser $informesUser)
    {
        //
    }
}
