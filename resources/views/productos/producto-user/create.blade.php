<form action="{{ route('productos-user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="CrearProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content px-3 py-2" style="background-color: #1D1B22; border-radius: 10px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" style="color: #808080;">Crear Producto</h1>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fas fa-xmark"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="row div-input py-2">
                                <!-- Nombre -->
                                <div class="col-2">
                                    <label for="nombre">Nombre:</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" name="nombre_producto" class="form-control" required>
                                </div>
                            </div>

                            <div class="row div-input py-2">
                                <!-- Descripción -->
                                <div class="col-2">
                                    <label for="descripcion">Descripción:</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" name="descripcion" class="form-control" required>
                                </div>
                            </div>

                            <div class="row div-input py-2">
                                <!-- Precio -->
                                <div class="col-2">
                                    <label for="precio">Precio:</label>
                                </div>
                                <div class="col-4">
                                    <input type="number" step="0.01" name="precio" class="form-control" required>
                                </div>

                                <!-- Stock -->
                                <div class="col-2">
                                    <label for="stock">Stock:</label>
                                </div>
                                <div class="col-4">
                                    <input type="number" name="stock" class="form-control" required>
                                </div>
                            </div>

                            <div class="row div-input py-2">
                                <!-- ID Categoría -->
                                <div class="col-2">
                                    <label for="id_categoria">Categoría:</label>
                                </div>
                                <div class="col-10">
                                    <select class="form-control" name="id_categoria" id="id_categoria" required>
                                        <option value="" disabled selected>Seleccionar categoría</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->categoria }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Usuario -->
                                <div class="col-10">
                                    <input type="hidden" name="id_usuario" value="{{ session('usuario.id_usuario') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <!-- Div para la vista previa de la imagen -->
                            <div class="image" id="image-preview">
                                <span class="text-muted">Vista previa</span>
                            </div>

                            <div class="row div-input py-2">
                                <!-- Imagen URL -->
                                <div class="col-8">
                                    <label for="imagen">Imagen:</label>
                                </div>
                                <div class="col-4">
                                    <!-- Input de archivo oculto -->
                                    <input type="file" name="imagen" id="imagen_url" class="d-none" required>

                                    <!-- Botón personalizado con ícono para cargar archivo -->
                                    <label for="imagen_url" class="btn btn-outline-light btn-sm">
                                        <span class="fas fa-image"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-info btn-sm">
                        <span class="fas fa-plus pe-2"></span>Crear
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Previsualizar imagen -->
<script>
    // Evento para previsualizar la imagen cuando se selecciona un archivo
    document.getElementById('imagen_url').addEventListener('change', function (event) {
        const imagePreview = document.getElementById('image-preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.style.backgroundImage = `url('${e.target.result}')`;
                imagePreview.style.backgroundSize = 'contain';
                imagePreview.style.backgroundPosition = 'center';
                imagePreview.style.backgroundRepeat = 'no-repeat';
                imagePreview.innerHTML = '';
            };

            reader.readAsDataURL(file);
        } else {
            resetImagePreview();
        }
    });

    // Evento para limpiar la vista previa de la imagen cuando se cierra el modal
    document.getElementById('CrearModal').addEventListener('hidden.bs.modal', function () {
        resetImagePreview();
    });

    // Función para restablecer el contenido del div de vista previa
    function resetImagePreview() {
        const imagePreview = document.getElementById('image-preview');
        imagePreview.style.backgroundImage = '';
        imagePreview.innerHTML = '<span class="text-muted">Vista previa</span>';
    }
</script>