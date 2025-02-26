<!doctype html>
<html lang="en">

<head>
    <title>Sidebar 08</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/sidebar-productos.css') }}?v={{ time() }}">

    <script defer src="{{ asset('js/sidebar-productos.js') }}"></script>
</head>

<body>

    <div class="container d-md-flex align-items-stretch">
        <nav id="sidebar">
            <div class="pt-5">
                <h5 class="text-dark">Categories</h5>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="#ModayAccesorios" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"><span class="fas fa-shirt me-2 icon-category"></span>Moda y Accesorios</a>
                        <ul class="collapse list-unstyled" id="ModayAccesorios">
                            @foreach ($categorias as $categoria)
                            <li>
                                <a href="{{ route('productos.index', ['categoria' => $categoria->id_categoria]) }}">
                                    <span class="fa fa-chevron-right mr-2"></span> {{ $categoria->categoria }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="#ElectrónicayTegnologia" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"><span class="fas fa-computer me-2 icon-category"></span>Electrónica y Tegnología</a>
                        <ul class="collapse list-unstyled" id="ElectrónicayTegnologia">
                            @foreach ($categorias as $categoria)
                            <li>
                                <a href="{{ route('productos.index', ['categoria' => $categoria->id_categoria]) }}">
                                    <span class="fa fa-chevron-right mr-2"></span> {{ $categoria->categoria }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="#HogaryDecoracion" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"><span class="fas fa-couch me-2 icon-category"></span>Hogar y Decoración</a>
                        <ul class="collapse list-unstyled" id="HogaryDecoracion">
                            @foreach ($categorias as $categoria)
                            <li>
                                <a href="{{ route('productos.index', ['categoria' => $categoria->id_categoria]) }}">
                                    <span class="fa fa-chevron-right mr-2"></span> {{ $categoria->categoria }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="#AlimentosyBebidas" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"><span class="fas fa-pizza-slice me-2 icon-category"></span>Alimentos y Bebidas</a>
                        <ul class="collapse list-unstyled" id="AlimentosyBebidas">
                            @foreach ($categorias as $categoria)
                            <li>
                                <a href="{{ route('productos.index', ['categoria' => $categoria->id_categoria]) }}">
                                    <span class="fa fa-chevron-right mr-2"></span> {{ $categoria->categoria }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <div class="mb-5">
                    <h5 class="text-dark">Tag Cloud</h5>
                    <div class="tagcloud">
                        <a href="#" class="tag-cloud-link">dish</a>
                        <a href="#" class="tag-cloud-link">menu</a>
                        <a href="#" class="tag-cloud-link">food</a>
                        <a href="#" class="tag-cloud-link">sweet</a>
                        <a href="#" class="tag-cloud-link">tasty</a>
                        <a href="#" class="tag-cloud-link">delicious</a>
                        <a href="#" class="tag-cloud-link">desserts</a>
                        <a href="#" class="tag-cloud-link">drinks</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</body>

</html>