<?php

namespace App\Http\Controllers;

use App\Models\DashboardUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalProductos = DB::select('CALL sp_dash_TotalProductos()')[0]->total_productos;
        $totalProveedores = DB::select('CALL sp_dash_TotalProveedores()')[0]->total_proveedores;
        $totalIngresos = DB::select('CALL sp_dash_TotalIngresos()')[0]->total_ingresos;
        $totalPedidos = DB::select('CALL sp_dash_TotalPedidos()')[0]->total_pedidos;

        // -------------------- Linechart --------------------------//
        $ventasPorMes = DB::select('CALL sp_dash_TotalVentasPorMes()');
        // Extraer las etiquetas (meses) y datos (total de ventas)
        $labels = [];
        $data = [];
        foreach ($ventasPorMes as $venta) {
            $labels[] = $venta->mes . ' ' . $venta->anio; // Ejemplo: "Enero 2024"
            $data[] = $venta->total_ventas;
        }
        // Crear el gráfico
        $chartLine = new Chart();
        $chartLine->labels($labels); // Usar los meses como etiquetas
        $chartLine->dataset('Ventas', 'line', $data)
            ->color('#ff0000') // Color de las líneas
            ->backgroundColor('#ffcccc'); // Color de las barras

        // -------------------- Barchart Vertical --------------------------//
        $ventasPorCategoria = DB::select('CALL sp_dash_TotalVentasPorCategoria()');
        // Extraer las etiquetas (categorías) y datos (total de ventas)
        $labels = [];
        $data = [];
        foreach ($ventasPorCategoria as $venta) {
            $labels[] = $venta->nombre_categoria; // Ejemplo: "Electrónica", "Ropa"
            $data[] = $venta->total_ventas;
        }
        // Crear el gráfico
        $chartVerticalBar = new Chart();
        $chartVerticalBar->labels($labels); // Usar las categorías como etiquetas
        $chartVerticalBar->dataset('Ventas por Categoría', 'bar', $data)
            ->color('#007bff') // Color de las líneas
            ->backgroundColor('#cce5ff'); // Color de las barras

        // -------------------- Barchart Vetical --------------------------//
        $ventasPorProveedor = DB::select('CALL sp_dash_TotalVentasPorProveedores()');
        // Extraer los datos de proveedores y sus ventas
        $labels = [];
        $data = [];
        foreach ($ventasPorProveedor as $venta) {
            $labels[] = $venta->username; // Usar el nombre de usuario del proveedor
            $data[] = $venta->total_ventas; // Total de ventas del proveedor
        }
        // Crear el gráfico
        $chartVerticalBar2 = new Chart();
        $chartVerticalBar2->labels($labels); // Usar los nombres de los proveedores como etiquetas
        $chartVerticalBar2->dataset('Ventas por Proveedor', 'bar', $data)
            ->color('#28a745') // Color de las barras
            ->backgroundColor('#d4edda'); // Color de fondo de las barras

        // -------------------- Barchart Horizontal --------------------------//
        $topProductos = DB::select('CALL sp_dash_TopProductosMasVendidos()');
        // Extraer los datos de productos y cantidad vendida
        $labels = [];
        $data = [];
        foreach ($topProductos as $producto) {
            $labels[] = $producto->producto; // Nombre del producto
            $data[] = $producto->cantidad_vendida; // Cantidad vendida
        }
        // Crear el gráfico de barras horizontal
        $chartHorizontalBar = new Chart();
        $chartHorizontalBar->labels($labels); // Usar los nombres de los productos como etiquetas
        $chartHorizontalBar->dataset('Cantidad Vendida', 'bar', $data)
            ->color('#007bff') // Color de las barras
            ->backgroundColor('#cce5ff'); // Color de fondo de las barras

        $chartHorizontalBar->options([
            'indexAxis' => 'y', // Cambia el eje a horizontal
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                ],
            ],
        ]);

        return view('usuarios/funciones-usuario/dashboard', compact(
            'chartLine',
            'chartVerticalBar',
            'chartVerticalBar2',
            'chartHorizontalBar',
            'totalProductos',
            'totalProveedores',
            'totalIngresos',
            'totalPedidos'
        ));
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
    public function show(DashboardUser $dashboardUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DashboardUser $dashboardUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DashboardUser $dashboardUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DashboardUser $dashboardUser)
    {
        //
    }
}
