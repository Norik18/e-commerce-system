@extends('layout/navbar')

@section("TituloPagina", "Productos")

@section('contenido')

<div class="container mt-5">
    <!-- Breadcrumb de navegación -->
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $producto->nombre_producto }}</li>
        </ul>
    </nav>

    <div class="row">
        <div class="col-2">

        </div>
        <!-- Columna de la imagen del producto -->
        <div class="col-4 text-center move-left">
            <div class="position-relative">
                <!-- Imagen principal del producto -->
                <img src="{{ route('productos-user.image', $producto->id_producto) }}" class="img-fluid"
                    alt="Imagen del producto">

                <!-- Descuento, si aplica -->
                @if($producto->stock > 10)
                    <div class="badge bg-primary discount">-10%</div>
                @endif
            </div>
        </div>

        <!-- Detalles del producto -->
        <div class="col-6">
            <div class="row">
                <p class="text-font">{{ $producto->username }}</p>
            </div>
            <div class="row">
                <p class="text-font">SKU:{{ $producto->id_producto }}</p>
            </div>

            <div class="row">
                <h4>{{ $producto->nombre_producto }}</h4>
            </div>

            <div class="row">
                <!-- Calificacion -->
            </div>

            <div class="row">
                <!-- Precio del producto con descuento si aplica -->
                <h4 class="price">S/ {{ number_format($producto->precio, 2) }}
                    @if($producto->stock > 10)
                        <span class="original-price">S/ {{ number_format($producto->precio * 1.1, 2) }}</span>
                    @endif
                </h4>
                <div class="row mb-3">
                    <p class="text-font">{{ $producto->categoria }}</p>
                </div>
            </div>

            <div class="row">
                <!-- Colores -->
            </div>

            <!-- Sección para cantidad y agregar al carrito -->
            <div class="row">
                <div class="col-3 mb-3">
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon1">-</button>
                        <input type="number" value="1" min="1" class="form-control text-center" id="cantidad" />
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">+</button>
                    </div>
                </div>
                <div class="col-9">
                    <button class="btn btn-outline-dark agregar-carrito" 
                        data-id="{{ $producto->id_producto }}"
                        data-nombre="{{ $producto->nombre_producto }}" 
                        data-precio="{{ $producto->precio }}"
                        data-imagen="{{ route('productos-user.image', $producto->id_producto) }}"
                        data-categoria="{{ $producto->categoria }}" 
                        data-username="{{ $producto->username }}">
                        Agregar al carrito
                    </button>
                </div>
            </div>

            <div class="row">
                <p class="text-font">Unidades disponibles: {{ $producto->stock }}</p>
            </div>

            <hr>
            <!-- Opciones de envío -->
            <div class="row d-flex justify-content-around">
                <div class="col-4 d-flex align-items-center">
                    <span id="icon-recojo" class="fas fa-motorcycle fs-3"></span>
                    <div>
                        <p class="text-font">Envio Hoy (Recibe Hoy)</p>
                        <a class="text-font" href="#">No disponible</a>
                    </div>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <span id="icon-recojo" class="fas fa-truck fs-3"></span>
                    <div>
                        <p class="text-font">Envio programado</p>
                        <a class="text-font" href="#">No disponible</a>
                    </div>
                </div>
                <div class="col-4 d-flex align-items-center">
                    <span id="icon-recojo" class="fas fa-store fs-3"></span>
                    <div>
                        <p class="text-font">Retiro en tienda</p>
                        <a class="text-font" href="#">No disponible</a>
                    </div>
                </div>
            </div>

            <hr>
        </div>
    </div>
</div>
@endsection