@extends('layout/navbar')

@section("TituloPagina", "Reclamaciones")

@section('contenido')

<div>
    @include('layout.sidebar-user')
</div>


<div class="container">
    <h1>Listado de Reclamaciones</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Tipo de Documento</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Tipo de Bien</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reclamos as $reclamo)
                <tr>
                    <td>{{ $reclamo->tipo_documento }}</td>
                    <td>{{ $reclamo->numero_documento}}</td>
                    <td>{{ $reclamo->nombres }} {{ $reclamo->apellido_paterno }}</td>
                    <td>{{ $reclamo->tipo_bien }}</td>
                    <td class="text-center">
                        <a href="{{ route('reclamaciones.show', $reclamo->id_reclamo) }}" class="btn btn-info btn-sm">
                            <span class="fas fa-file-lines"></span></a>

                        <!-- Formulario para eliminar -->
                        <form action="{{ route('reclamaciones.destroy', $reclamo->id_reclamo) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este reclamo?')">
                                <span class="far fa-trash-can"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection