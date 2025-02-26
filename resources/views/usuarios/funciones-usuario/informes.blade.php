@extends('layout.navbar')

@section("TituloPagina", "Informes de Ventas")

@section('contenido')

<div>
    @include('layout.sidebar-user')
</div>

<style>
    .to{
        margin-top: -30px;
    }
</style>

<div class="container to">
    <div class="row">
        <!-- Mostrar todas las ventas -->
        <div class="col-md-12">
            <h3>Listado de Ventas</h3>
            
            <!-- Botones para generar informes PDF -->
            <div class="btn-group mb-3" role="group">
                <a href="{{ url('/informes/pdf/diario') }}" class="btn btn-primary">Informe Diario (PDF)</a>
                <a href="{{ url('/informes/pdf/semanal') }}" class="btn btn-success">Informe Semanal (PDF)</a>
                <a href="{{ url('/informes/pdf/mensual') }}" class="btn btn-warning">Informe Mensual (PDF)</a>
            </div>

            <!-- Tabla de todas las ventas -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Fecha</th>
                        <th>Tipo Comprobante</th>
                        <th>Subtotal</th>
                        <th>IGV</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id_venta }}</td>
                            <td>{{ $venta->fecha }}</td>
                            <td>{{ $venta->tipo_comprobante }}</td>
                            <td>${{ number_format($venta->subtotal, 2) }}</td>
                            <td>${{ number_format($venta->igv, 2) }}</td>
                            <td>${{ number_format($venta->total, 2) }}</td>
                            <td>{{ $venta->estado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
