@extends('layout/navbar')

@section("TituloPagina", "Dashboard")

@section('contenido')

<div>
    @include('layout.sidebar-user')
</div>

<div class="container">

    <h1>Dashboard</h1>

    <div class="row dashboard">
        <div class="col-2">

        </div>
        <div class="col-10">
            <div class="row dashboard-card">
                <div class="col-2">
                    <div class="dashboard-title">
                        <p>Productos</p>
                        <span class="fas fa-bag-shopping"></span>
                    </div>
                    <div>
                        <h2>{{ $totalProductos }}</h2>
                    </div>
                </div>
                <div class="col-2">
                    <div class="dashboard-title">
                        <p>Proveedores</p>
                        <span class="fas fa-handshake"></span>
                    </div>
                    <div>
                        <h2>{{ $totalProveedores }}</h2>
                    </div>
                </div>
                <div class="col-2">
                    <div class="dashboard-title">
                        <p>Ingresos</p>
                        <span class="fas fa-dollar-sign"></span>
                    </div>
                    <div>
                        <h2>S/.{{ number_format($totalIngresos, 2) }}</h2>
                    </div>
                </div>
                <div class="col-2">
                    <div class="dashboard-title">
                        <p>Pedidos</p>
                        <span class="fas fa-box"></span>
                    </div>
                    <div>
                        <h2>{{ $totalPedidos }}</h2>
                    </div>
                </div>
                <div class="col-2">
                    <div class="dashboard-title">
                        <p>Devolución</p>
                        <span class="fas fa-dolly"></span>
                    </div>
                    <div>
                        <h2></h2>
                    </div>
                </div>
                <div class="col-2">
                    <div class="dashboard-title">
                        <p>Reembolsos</p>
                        <span class="fas fa-hand-holding-dollar"></span>
                    </div>
                    <div>
                        <h2></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Renderizar el gráfico -->
                <div class="col-8" style="margin: auto;">
                    {!! $chartLine->container() !!}
                </div>
                <div class="col-4" style="margin: auto;">
                    {!! $chartVerticalBar->container() !!}
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-2" style="margin: auto;">

                        </div>
                        <div class="col-4" style="margin: auto;">
                            {!! $chartVerticalBar2->container() !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4" style="margin: auto;">

                        </div>
                        <div class="col-2" style="margin: auto;">

                        </div>
                    </div>
                </div>
                <div class="col-3" style="margin: auto;">

                </div>
                <div class="col-3" style="margin: auto;">

                </div>
            </div>

            <div class="row">
                <!-- Renderizar el gráfico -->
                <div class="col-7" style="margin: auto;">
                    {!! $chartHorizontalBar->container() !!}
                </div>
                <div class="col-5" style="margin: auto;">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Agregar la CDN de FusionCharts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{!! $chartLine->script() !!}
{!! $chartVerticalBar->script() !!}
{!! $chartVerticalBar2->script() !!}
{!! $chartHorizontalBar->script() !!}





@endsection