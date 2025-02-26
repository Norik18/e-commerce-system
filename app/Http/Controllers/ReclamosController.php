<?php

namespace App\Http\Controllers;

use App\Models\Reclamos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReclamosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reclamos = DB::select('CALL sp_MostrarReclamaciones()');
        return view('reclamaciones/reclamos', compact('reclamos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reclamaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $validatedData = $request->validate([
            'tipo_documento' => 'required|string|max:20',
            'numero_documento' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'distrito' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'correo_electronico' => 'required|email|max:255',
            'medio_respuesta' => 'required|string|max:255',
            'tipo_bien' => 'required|array',
            'descripcion_bien' => 'nullable|string|max:500',
            'tipo_bien.*' => 'in:Producto,Servicio',
            'monto_reclamado' => 'required|numeric',
            'motivo_contacto' => 'required|string|max:255',
            'detalle' => 'required|string|max:800',
            'pedido' => 'required|string|max:300',
        ]);

        try {
            // Convertir el array de tipo_bien en una cadena separada por comas
            $tipoBien = implode(',', $validatedData['tipo_bien']);

            // Llamar al procedimiento almacenado
            \DB::statement('CALL sp_CrearReclamacion(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $validatedData['tipo_documento'],
                $validatedData['numero_documento'],
                $validatedData['apellido_paterno'],
                $validatedData['apellido_materno'] ?? null,
                $validatedData['nombres'],
                $validatedData['apoderado'] ?? null,
                $validatedData['direccion'],
                $validatedData['urbanizacion'] ?? null,
                $validatedData['departamento'],
                $validatedData['provincia'],
                $validatedData['distrito'],
                $validatedData['referencia'] ?? null,
                $validatedData['telefono'] ?? null,
                $validatedData['celular'],
                $validatedData['correo_electronico'],
                $validatedData['medio_respuesta'],
                $tipoBien,
                $validatedData['descripcion_bien'] ?? null,
                $validatedData['monto_reclamado'],
                $validatedData['motivo_contacto'],
                $validatedData['detalle'],
                $validatedData['pedido'],
            ]);

            return redirect()->route('home.index')->with('success', 'Reclamación enviada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al enviar la reclamación: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id_reclamo)
    {
        try {
            // Llamar al procedimiento almacenado para obtener los detalles
            $reclamacion = \DB::select('CALL sp_DetalleReclamacion(?)', [$id_reclamo]);

            // Verificar si se encontraron resultados
            if (empty($reclamacion)) {
                return redirect()->route('reclamaciones.index')
                    ->withErrors(['error' => 'Reclamación no encontrada.']);
            }

            // Convertir el resultado a un objeto y transformar las fechas a instancias de Carbon
            $reclamo = (object) $reclamacion[0];
            $reclamo->created_at = $reclamo->created_at ? Carbon::parse($reclamo->created_at) : null;
            $reclamo->updated_at = $reclamo->updated_at ? Carbon::parse($reclamo->updated_at) : null;

            // Pasar el resultado (convertido en un objeto) a la vista
            return view('reclamaciones.show', ['reclamo' => (object) $reclamacion[0]]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al obtener la reclamación: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reclamos $reclamos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reclamos $reclamos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_reclamo)
    {
        try {
            // Llamar al procedimiento almacenadoid_reclamo
            DB::statement('CALL sp_EliminarReclamacion(?)', [$id_reclamo]);

            return redirect()->route('reclamaciones.index')->with('success', 'Reclamación eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al eliminar la reclamación: ' . $e->getMessage()]);
        }
    }
}
