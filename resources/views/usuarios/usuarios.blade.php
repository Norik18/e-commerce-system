@extends('layout/navbar')

@section("TituloPagina", "Usuarios")

@section('contenido')

<style>
    .to{
        margin-top: -40px;
    }
</style>

<main>
    <div class="container-fluid px-5 pt-4 to">
        <!-- Buscador y contador en la misma línea -->
        <div class="search-container d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <span class="position-absolute fas fa-magnifying-glass ps-2"></span>
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar">
            </div>
            <div id="recordCount" class="ms-2"></div>
        </div>

        <!-- Tabla responsiva de Bootstrap -->
        <div class="table-responsive">
            <table class="table table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <!-- <th>Apellido Materno</th>-->
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Username</th>
                        <th>Rol</th>
                        <th>Estado</th>
                         <!-- <th>Fecha de Creación</th>-->
                        <!--<th>Última Modificación</th>-->
                        <!--<th>Última Sesión</th>-->
                         <!-- <th>Intentos Fallidos</th>-->
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id_usuario }}</td>
                            <td>{{ $usuario->dni }}</td>
                            <td>{{ $usuario->nombres }}</td>
                            <td>{{ $usuario->apellido_paterno }}</td>
                           <!--  <td>{{ $usuario->apellido_materno }}</td>-->
                            <td>{{ $usuario->direccion }}</td>
                            <td>{{ $usuario->correo_electronico }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->username }}</td>
                            <td>{{ $usuario->tipo_usuario }}</td>
                            <td>{{ $usuario->estado }}</td>
                           <!--  <td>{{ $usuario->fecha_creacion }}</td>-->
                            <!-- <td>{{ $usuario->fecha_modificacion }}</td>-->
                            <!-- <td>{{ $usuario->fecha_ultima_sesion }}</td>-->
                            <!-- <td>{{ $usuario->intentos_fallidos }}</td>-->
                            <td class="d-flex justify-content-around">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#ActualizarModal{{$usuario->id_usuario}}">
                                    <span class="far fa-pen-to-square"></span>
                                </button>
                                @include('usuarios/modal-usuario.update')

                                &nbsp;

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#EliminarModal{{$usuario->dni}}">
                                    <span class="far fa-trash-alt"></span>
                                </button>
                                @include('usuarios/modal-usuario.delete')  
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    // Función de búsqueda
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.querySelector('tbody'); // Cambiar para seleccionar tbody directamente
    const recordCount = document.getElementById('recordCount');

    function updateRecordCount() {
        const visibleRows = tableBody.querySelectorAll('tr:not([style*="display: none"])');
        recordCount.textContent = `Total de registros: ${visibleRows.length}`;
    }

    searchInput.addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = tableBody.querySelectorAll('tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            let textContent = '';
            cells.forEach(cell => {
                textContent += cell.textContent.toLowerCase() + ' ';
            });
            row.style.display = textContent.includes(filter) ? '' : 'none';
        });
        updateRecordCount(); // Actualiza el conteo de registros
    });

    // Actualiza el conteo de registros al cargar la página
    updateRecordCount();
</script>

@endsection



