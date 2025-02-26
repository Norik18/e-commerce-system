<form action="{{ route('productos-user.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="ActualizarProductoUserModal{{$producto->id_producto}}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content px-3 py-2" style="background-color: #1D1B22; border-radius: 10px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" style="color: #808080;">
                        Actualizar Producto</h1>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fas fa-xmark"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ID del Producto (oculto) -->
                    <input type="hidden" name="id_producto" value="{{$producto->id_producto}}">

                    <div class="row">
                        <div class="col-9">
                            <div class="row div-input py-2">
                                <!-- Nombre -->
                                <div class="col-2">
                                    <label for="nombre">Nombre:</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" name="nombre_producto" class="form-control"
                                        value="{{$producto->nombre_producto}}" required>
                                </div>
                            </div>

                            <div class="row div-input py-2">
                                <!-- Descripción -->
                                <div class="col-2">
                                    <label for="descripcion">Descripción:</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" name="descripcion" class="form-control"
                                        value="{{$producto->descripcion}}" required>
                                </div>
                            </div>

                            <div class="row div-input py-2">
                                <!-- Precio -->
                                <div class="col-2">
                                    <label for="precio">Precio:</label>
                                </div>
                                <div class="col-4">
                                    <input type="number" step="0.01" name="precio" class="form-control"
                                        value="{{$producto->precio}}" required>
                                </div>

                                <!-- Stock -->
                                <div class="col-2">
                                    <label for="stock">Stock:</label>
                                </div>
                                <div class="col-4">
                                    <input type="number" name="stock" class="form-control" value="{{$producto->stock}}"
                                        required>
                                </div>
                            </div>

                            <div class="row div-input py-2">
                                <!-- ID Categoría -->
                                <div class="col-2">
                                    <label for="id_categoria">Categoría:</label>
                                </div>
                                <div class="col-10">
                                <select class="form-control" name="id_categoria" id="id_categoria" required>
                                    <option value="" disabled>Seleccione una categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id_categoria }}" 
                                            {{ $producto->categoria == $categoria->categoria ? 'selected' : '' }}>
                                            {{ $categoria->categoria }}
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <!-- Div para la vista previa de la imagen -->
                            <div class="image" id="image-preview-{{$producto->id_producto}}">
                                @if($producto->imagen)
                                    <!-- Convertir la imagen binaria a base64 para mostrar -->
                                    <img src="data:image/png;base64,{{ base64_encode($producto->imagen) }}"
                                        alt="Imagen del producto" class="img-fluid rounded">
                                @else
                                    <span class="text-muted">Sin vista previa</span>
                                @endif
                            </div>

                            <div class="row div-input py-2">
                                <!-- Imagen URL -->
                                <div class="col-2">
                                    <label for="imagen">Imagen:</label>
                                </div>
                                <div class="col-10">
                                    <!-- Input de archivo -->
                                    <input type="file" name="imagen" id="imagen_url_{{$producto->id_producto}}"
                                        class="d-none">

                                    <!-- Botón personalizado con ícono para cargar archivo -->
                                    <label for="imagen_url_{{$producto->id_producto}}"
                                        class="btn btn-outline-light btn-sm">
                                        <span class="fas fa-image"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-info btn-sm">
                        <span class="fas fa-file-pen me-2"></span>Actualizar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Previsualizar imagen -->
<script>
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function (event) {
            const file = event.target.files[0]; // Obtiene el archivo seleccionado
            const previewId = `image-preview-${this.id.split('_').pop()}`; // Construye el ID dinámico del preview
            const preview = document.getElementById(previewId);

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Actualiza la vista previa con la nueva imagen
                    preview.innerHTML = `<img src="${e.target.result}" alt="Nueva imagen" class="img-fluid rounded">`;
                };

                reader.readAsDataURL(file); // Lee el archivo como DataURL
            } else {
                // Si no hay archivo, muestra el texto por defecto
                preview.innerHTML = `<span class="text-muted">Sin vista previa</span>`;
            }
        });
    });
</script>