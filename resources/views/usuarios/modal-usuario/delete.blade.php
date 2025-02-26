<form action="{{route('usuarios.destroy', $usuario->dni)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="EliminarModal{{$usuario->dni}}" tabindex="-1" aria-labelledby="EliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3" style="background-color: #1D1B22;">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="EliminarModalLabel" style="color: #808080;">Eliminar Usuario</h1>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fas fa-xmark"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center py-3" style="color: #808080;">¿Estás seguro de que deseas eliminar al
                        usuario?</h6>
                    <div class="row div-input justify-content-center">
                        <div class="col-2">
                            <label for="dni">DNI</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="dni" class="form-control" value="{{$usuario->dni}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">
                        <span class="fas fa-trash-alt"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
