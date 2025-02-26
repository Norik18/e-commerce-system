@extends('layout/navbar')

@section("TituloPagina", "Productos")

@section('contenido')

<div class="container my-5">
    <div class="row">

        <aside class="col-3">
            @include('layout.sidebar-productos')
        </aside>


        <div class="col-9">
            <div class="row align-items-center">
                <div class="col-8">
                    <nav id="sidebar">
                        <div class="p-4 pt-5">
                            <ul class="list-unstyled components mb-5">
                                <li>
                                    <a href="#filtro" data-toggle="collapse" aria-expanded="false"
                                        class="dropdown-toggle">Mens Shoes</a>
                                    <ul class="collapse list-unstyled" id="filtro">
                                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Precio más
                                                bajo</a>
                                        </li>
                                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Precio más
                                                alto</a>
                                        </li>
                                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Los más
                                                vendidos</a>
                                        </li>
                                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> A - Z</a></li>
                                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Z - A</a></li>
                                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Lo más nuevo</a>
                                        </li>
                                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Mejor
                                                descuento</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- Buscador y contador en la misma línea -->
                <div class="col-4 d-flex align-items-center">
                    <span class="position-absolute fas fa-magnifying-glass ps-2"></span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar">
                </div>
            </div>

            <div class="d-grid justify-content-end align-items-center my-2">
                <div id="recordCount" class=""></div>
            </div>

            <h1 class="section-title fs-2 text-dark">Catálogo de Productos</h1>

            <article>
                <div class="row">
                    @foreach($productos as $producto)
                        <div class="col-3">
                            <div class="product-card" data-category="{{ strtolower($producto->categoria) }}">
                                <a href="{{ route('productos.show', $producto->id_producto) }}" class="product-card-link">
                                    @if($producto->stock > 40)
                                        <div class="badge">-10%</div>
                                    @endif
                                    <div class="product-tumb">
                                        <img class="img-product mx-auto d-block"
                                            src="{{ route('productos-user.image', $producto->id_producto) }}"
                                            alt="Imagen del producto">
                                    </div>
                                    <div class="product-details">
                                        <span class="product-catagory">{{ $producto->username }}</span>
                                        <h6>{{ $producto->nombre_producto }}</h6>
                                        <div class="product-bottom-details">
                                            <div class="product-price">S/ {{ number_format($producto->precio, 2) }}</div>
                                            <div class="product-links">
                                                <a href=""><i class="fa fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </article>
        </div>
    </div>
</div>

<script>
    // Función de búsqueda
    const searchInput = document.getElementById('searchInput');
    const productCards = document.querySelectorAll('.product-card');
    const recordCount = document.getElementById('recordCount');

    function updateRecordCount() {
        const visibleCards = document.querySelectorAll('.product-card:not([style*="display: none"])');
        recordCount.textContent = `Total de productos: ${visibleCards.length}`;
    }

    searchInput.addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();

        productCards.forEach(card => {
            // Se accede a los datos de cada producto (nombre, categoría, precio)
            const productName = card.querySelector('h6').textContent.toLowerCase();
            const productCategory = card.querySelector('.product-catagory').textContent.toLowerCase();
            const productPrice = card.querySelector('.product-price').textContent.toLowerCase();

            // Verificar si el texto de búsqueda está presente en alguno de estos campos
            const textContent = productName + ' ' + productCategory + ' ' + productPrice;
            card.style.display = textContent.includes(filter) ? '' : 'none';
        });

        updateRecordCount(); // Actualiza el conteo de registros
    });

    // Actualiza el conteo de registros al cargar la página
    updateRecordCount();
</script>

@endsection