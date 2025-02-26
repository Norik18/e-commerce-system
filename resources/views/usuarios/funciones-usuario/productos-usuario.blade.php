@extends('layout/navbar')

@section("TituloPagina", "Mis Productos")

@section('contenido')

<div>
    @include('layout.sidebar-user')
</div>

<div class="container">
    <div class="row align-items-center">
        <nav class="col-8" id="sidebar">
            <div class="p-4 pt-5">
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="#filtro" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Mens
                            Shoes</a>
                        <ul class="collapse list-unstyled" id="filtro">
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Precio más bajo</a>
                            </li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Precio más alto</a>
                            </li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Los más vendidos</a>
                            </li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> A - Z</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Z - A</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Lo más nuevo</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Mejor descuento</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Buscador y contador en la misma línea -->
        <div class="col-3 d-flex align-items-center">
            <span class="position-absolute fas fa-magnifying-glass ps-2"></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar">
        </div>
        
        <div class="col-1 d-flex justify-content-end">
            <button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal"
                data-bs-target="#CrearProductoModal">
                <span class="fas fa-plus"></span>
            </button>
            @include('productos/producto-user.create')
        </div>
    </div>

    <article>
        <div class="row">
            @foreach($productos as $producto)
            <div class="col-2">
                <div class="product-user-card" data-category="{{ strtolower($producto->categoria) }}">
                    <div class="product-user-tumb">
                        <img class="img-product-user mx-auto d-block"
                            src="{{ route('productos-user.image', $producto->id_producto) }}" alt="Imagen del producto">
                    </div>
                    <div class="product-user-details">
                        <span class="product-user-text">Categoria: {{ $producto->categoria }}</span>
                        <h6 class="product-user-text">Producto: {{ $producto->nombre_producto }}</h6>
                        <div class="product-user-text">Precio: S/{{ number_format($producto->precio, 2) }}</div>
                        <div class="product-user-text">Stock: {{ $producto->stock }}</div>
                        <div class="product-user-edit">
                            <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#ActualizarProductoUserModal{{$producto->id_producto}}">
                                <span class="fas fa-file-pen"></span>
                            </button>
                            @include('productos/producto-user.update')
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </article>
</div>


@endsection