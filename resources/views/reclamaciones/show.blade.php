@extends('layout/navbar')

@section("TituloPagina", "Reclamaciones")

@section('contenido')

<div>
    @include('layout.sidebar-user')
</div>

<div class="container">
    <h2>Detalles del Reclamo</h2>
    <div>
        <p><strong>Tipo de Documento:</strong> {{ $reclamo->tipo_documento }}</p>
        <p><strong>Número de Documento:</strong> {{ $reclamo->numero_documento }}</p>
        <p><strong>Apellido Paterno:</strong> {{ $reclamo->apellido_paterno }}</p>
        <p><strong>Nombres:</strong> {{ $reclamo->nombres }}</p>
        <p><strong>Dirección:</strong> {{ $reclamo->direccion }}</p>
        <p><strong>Departamento:</strong> {{ $reclamo->departamento }}</p>
        <p><strong>Provincia:</strong> {{ $reclamo->provincia }}</p>
        <p><strong>Distrito:</strong> {{ $reclamo->distrito }}</p>
        <p><strong>Correo Electrónico:</strong> {{ $reclamo->correo_electronico }}</p>
        <p><strong>Tipo de Bien:</strong> {{ $reclamo->tipo_bien }}</p>
        <p><strong>Descripción del Bien:</strong> {{ $reclamo->descripcion_bien }}</p>
        <p><strong>Monto Reclamado:</strong> S/ {{ number_format($reclamo->monto_reclamado, 2) }}</p>
        <p><strong>Motivo de Contacto:</strong> {{ $reclamo->motivo_contacto }}</p>
        <p><strong>Detalle:</strong> {{ $reclamo->detalle }}</p>
        <p><strong>Pedido:</strong> {{ $reclamo->pedido }}</p>

        <p><strong>Fecha de Creación:</strong>
            {{ $reclamo->created_at ? $reclamo->created_at->format('d/m/Y') : 'No disponible' }}
        </p>
        <p><strong>Última Actualización:</strong>
            {{ $reclamo->updated_at ? $reclamo->updated_at->format('d/m/Y') : 'No disponible' }}
        </p>





        <!-- Botón de eliminación -->
        <form action="{{ route('reclamaciones.destroy', $reclamo->id_reclamo) }}" method="POST">
            @csrf
            @method('DELETE')
            <a href="{{ route('reclamaciones.index') }}" class="btn btn-secondary">Volver</a>
            <button type="submit" class="btn btn-danger">Eliminar Reclamo</button>
        </form>
    </div>
</div>

@endsection