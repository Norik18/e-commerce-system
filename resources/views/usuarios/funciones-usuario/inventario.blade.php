@extends('layout/navbar')

@section("TituloPagina", "Home")

@section('contenido')

<div>
    @include('layout.sidebar-user')
</div>

<div class="container my-5">
    <h1 class="mb-4">Inventario de Productos</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Stock</th>
                <th>Precio Actual</th>
                <th>Historial de Precios</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosAgrupados as $productoId => $productoGroup)
                        @php
                            $producto = $productoGroup->first(); // Información básica del producto
                        @endphp
                        <tr>
                            <td>{{ $producto->nombre_producto }}</td>
                            <td>{{ $producto->categoria }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>S/ {{ number_format($producto->precio_actual, 2) }}</td>
                            <td>
                                <ul>
                                    @foreach($productoGroup as $historial)
                                        <li>
                                            {{ $historial->fecha_cambio }}:
                                            De S/ {{ number_format($historial->precio_anterior, 2) }}
                                            a S/ {{ number_format($historial->nuevo_precio, 2) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
