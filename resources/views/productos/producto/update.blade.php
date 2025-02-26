<form action="{{ route('productos.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="ActualizarModal{{$producto->id_producto}}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Producto</h1>
                </div>
                <div class="modal-body">
                    <!-- ID del Producto (oculto) -->
                    <input type="hidden" name="id_producto" value="{{$producto->id_producto}}">

                    <!-- Nombre -->
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{$producto->nombre}}" required>

                    <!-- Descripción -->
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" value="{{$producto->descripcion}}" required>
                    
                    <!-- Stock -->
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{$producto->stock}}" required>
                    
                    <!-- Precio -->
                    <label for="precio">Precio</label>
                    <input type="number" step="0.01" name="precio" class="form-control" value="{{$producto->precio}}" required>
                    
                    <!-- Imagen URL -->
                    <label for="imagen_url">Imagen URL</label>
                    <input type="text" name="imagen_url" class="form-control" value="{{$producto->imagen_url}}" required>
                    
                    <!-- ID Categoría -->
                    <label for="id_categoria">ID Categoría</label>
                    <input type="number" name="id_categoria" class="form-control" value="{{$producto->id_categoria}}" required>
                    
                    <!-- ID Usuario -->
                    <label for="id_usuario">ID Usuario</label>
                    <input type="number" name="id_usuario" class="form-control" value="{{$producto->id_usuario}}" required>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">
                        <span class="fas fa-edit"></span> Actualizar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
