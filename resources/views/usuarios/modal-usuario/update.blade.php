<form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="ActualizarModal{{$usuario->id_usuario}}" tabindex="-1" aria-labelledby="ActualizarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3" style="background-color: #1D1B22;">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="ActualizarModalLabel" style="color: #808080;">Actualizar Usuario</h1>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fas fa-xmark"></span>
                    </button>
                </div>
                <div class="modal-body">

                    <input  type="hidden" name="id_usuario" class="form-control" value="{{$usuario->id_usuario}}">

                    <div class="row div-input py-2">
                        <!-- DNI -->
                        <div class="col-2">
                            <label for="dni">DNI</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="dni" class="form-control" value="{{$usuario->dni}}" required>
                        </div>

                        <!-- Nombres -->
                        <div class="col-2">
                            <label for="nombres">Nombres</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="nombres" class="form-control" value="{{$usuario->nombres}}"
                                required>
                        </div>
                    </div>

                    <div class="row div-input py-2">
                        <!-- Apellido Paterno -->
                        <div class="col-2">
                            <label for="apellido_paterno">Apellido Paterno</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="apellido_paterno" class="form-control"
                                value="{{$usuario->apellido_paterno}}" required>
                        </div>

                        <!-- Apellido Materno -->
                        <div class="col-2">
                            <label for="apellido_materno">Apellido Materno</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="apellido_materno" class="form-control"
                                value="{{$usuario->apellido_materno}}" required>
                        </div>
                    </div>

                    <div class="row div-input py-2">
                        <!-- Dirección -->
                        <div class="col-2">
                            <label for="direccion">Dirección</label>
                        </div>
                        <div class="col-10">
                            <input type="text" name="direccion" class="form-control" value="{{$usuario->direccion}}"
                                required>
                        </div>
                    </div>

                    <div class="row div-input py-2">
                        <!-- Dirección -->
                        <div class="col-2">
                            <label for="correo_electronico">Correo eléctronico</label>
                        </div>
                        <div class="col-10">
                            <input type="text" name="correo_electronico" class="form-control" value="{{$usuario->correo_electronico}}"
                                required>
                        </div>
                    </div>

                    <div class="row div-input py-2">
                        <!-- Teléfono -->
                        <div class="col-2">
                            <label for="telefono">Teléfono</label>
                        </div>
                        <div class="col-4">
                            <input type="number" name="telefono" class="form-control" value="{{$usuario->telefono}}"
                                required>
                        </div>

                        <!-- Username -->
                        <div class="col-2">
                            <label for="username">Username</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="username" class="form-control" value="{{$usuario->username}}"
                                required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="row div-input py-2">
                        <div class="col-2">
                            <label for="password">Contraseña nueva</label>
                        </div>
                        <div class="col-4 d-flex align-items-center">
                            <span class="fas fa-eye"></span>
                            <input type="password" name="password" class="form-control" value="{{$usuario->password}}">           
                        </div>
                        <div class="col-2">
                            <label for="password">Repetir contraseña</label>
                        </div>
                        <div class="col-4 d-flex align-items-center">
                            <input type="password" name="" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">
                        <span class="fas fa-user-pen"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


