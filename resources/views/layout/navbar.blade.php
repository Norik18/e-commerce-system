<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('TituloPagina')</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script defer src="{{ asset('js/bootstrap/jquery.min.js') }}"></script>
    <script defer src="{{ asset('js/bootstrap/popper.js') }}"></script>
    <script defer src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script defer src="{{ asset('js/bootstrap/owl.carousel.min.js') }}"></script>
    <script defer src="{{ asset('js/dropdown.js') }}"></script>

</head>

<body>

    <!-- Navegación -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a class="navbar-brand text-light" href="{{route('home.index')}}">
                <img class="logo" src="{{ asset('img/logo-e-commerce.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-2">
                        <a class="nav-link" href="{{route('productos.index')}}">Catalogo</a>
                    </li>
                    @if(session('usuario.tipo_usuario') === 'Administrador')
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{route('usuarios.index')}}">Usuarios</a>
                        </li>
                    @endif
                </ul>
                <div class="d-flex align-items-center">
                    <span class="position-absolute fas fa-magnifying-glass ps-2"></span>
                    <input type="text" id="searchNavbar" class="form-control" placeholder="Buscar">
                </div>

                @if(session()->has('usuario'))
                    <div class="dropdown custom-dropdown">
                        <a href="#" data-toggle="dropdown"
                            class="btn btn-outline-light ms-2 d-flex align-items-center dropdown-link text-left"
                            aria-haspopup="true" aria-expanded="false" data-offset="0, 20">
                            {{ substr(session('usuario.nombres'), 0, 1) }}{{ substr(session('usuario.apellido_materno'), 0, 1) }}
                            <span class="fas fa-caret-down ms-2"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('perfil.index') }}"><span
                                    class="fas fa-user"></span>Perfil</a>
                            <a class="dropdown-item" href="{{ route('logout.logout') }}"><span
                                    class="fas fa-door-open"></span>Log out</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login.index') }}" class="btn btn-outline-light ms-2">
                        <span class="fa-regular fa-user"></span>
                    </a>
                @endif

                <a href="{{route('registro.index')}}" class="btn btn-outline-light ms-2">
                    <span class="fa-solid fa-address-card"></span>
                </a>

                <!-- Botón del carrito -->
                <button class="btn btn-outline-light ms-2" id="mostrar-carrito">
                    <span class="fas fa-cart-shopping"></span>
                    <span id="numero-productos" class="badge bg-danger ms-2">0</span>
                </button>

                <!-- Carrito de compras -->
                <div id="container"
                    style="position: relative; display: flex; flex-direction: column; align-items: center;">
                    <div id="carrito-contenido" class="carrito-contenido mt-4"
                        style="width: 400px; display: none; position: absolute; background: #fff; border: 1px solid #ccc; padding: 10px; top: 30%; right: 0; margin-top: 10px; z-index: 100;">
                        <h4>Carrito de Compras</h4>
                        <table id="lista-carrito" class="table table-borderless table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Imagen</th>
                                    <th style="text-align: center;">Nombre</th>
                                    <th style="text-align: center;">Precio</th>
                                    <th style="text-align: center;">Cantidad</th>
                                    <th style="text-align: center;"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="d-flex justify-content-around">
                            <button id="vaciar-carrito" class="btn btn-outline-danger btn-sm">
                                <span class="fas fa-trash-can me-2"></span>Vaciar Carrito
                            </button>

                            <a href="{{route('carrito.index')}}" class="btn btn-outline-success btn-sm ms-2">
                                <span class="fa-solid fa-cart-arrow-down me-2"></span>Ver carrito
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="contenido">
        @yield('contenido')
    </main>

    <!-- Para que los iconos reboten como las nalgas de tordoya -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const botones = document.querySelectorAll('.btn');

            // Aplica el efecto a cada botón
            botones.forEach(boton => {
                const icono = boton.querySelector('span');

                boton.addEventListener('mouseenter', () => {
                    icono.classList.add('fa-bounce');
                });

                boton.addEventListener('mouseleave', () => {
                    icono.classList.remove('fa-bounce');
                });
            });
        });
    </script>

    <!-- Agregar producto al carrito de compras -->
    <script>
        const carrito = document.getElementById('carrito-contenido');
        const listaProductos = document.querySelector('#lista-carrito tbody');
        const mostrarCarritoBtn = document.getElementById('mostrar-carrito');
        const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');
        const numeroProductos = document.getElementById('numero-productos'); // El elemento para mostrar el número de productos

        eventsListeners();

        function eventsListeners() {
            // Escucha el click en el botón de agregar al carrito
            const agregarCarritoBtns = document.querySelectorAll('.agregar-carrito');
            agregarCarritoBtns.forEach(btn => {
                btn.addEventListener('click', comprarProducto);
            });

            mostrarCarritoBtn.addEventListener('click', mostrarCarrito); // Mostrar carrito al hacer clic
            listaProductos.addEventListener('click', eliminarProducto);
            document.addEventListener('DOMContentLoaded', leerLS);
            vaciarCarritoBtn.addEventListener('click', vaciarCarrito);

            // Cerrar carrito si se hace clic fuera de él
            document.addEventListener('click', (e) => {
                if (!carrito.contains(e.target) && e.target !== mostrarCarritoBtn) {
                    carrito.style.display = 'none';
                }
            });

            // Evitar que el carrito se cierre cuando se hace clic dentro de su área
            carrito.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }

        function comprarProducto(e) {
            e.preventDefault();
            const producto = e.target;
            const cantidad = document.getElementById('cantidad').value;
            leerDatosProducto(producto, cantidad);
        }

        function leerDatosProducto(producto, cantidad) {
            const infoProducto = {
                imagen: producto.getAttribute('data-imagen'),
                titulo: producto.getAttribute('data-nombre'),
                precio: producto.getAttribute('data-precio'),
                categoria: producto.getAttribute('data-categoria'), 
                username: producto.getAttribute('data-username'),
                id: producto.getAttribute('data-id'),
                cantidad: cantidad
            };

            insertarProducto(infoProducto);
        }

        function insertarProducto(producto) {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td style="text-align: center;"><img src="${producto.imagen}" width="50" height="50"></td>
            <td style="text-align: center;">${producto.titulo}</td>
            <td style="text-align: center;">S/ ${parseFloat(producto.precio).toFixed(2)}</td>
            <td style="text-align: center;">${producto.cantidad}</td>
            <td style="text-align: center;">
                <a href="#" class="borrar-producto" data-id="${producto.id}">
                    <span class="fas fa-xmark"></span>
                </a>
            </td>
        `;
            listaProductos.appendChild(row);
            guardarProductoLocalStorage(producto);
            actualizarNumeroProductos(); // Actualiza el número de productos después de agregar
        }

        function mostrarCarrito(e) {
            e.stopPropagation(); // Evitar que el clic se propague al document
            carrito.style.display = (carrito.style.display === 'block') ? 'none' : 'block';
            leerLS();
        }

        function guardarProductoLocalStorage(producto) {
            let productos = obtenerProductosLocalStorage();
            productos.push(producto);
            localStorage.setItem('productos', JSON.stringify(productos));
        }

        function obtenerProductosLocalStorage() {
            let productosLS = localStorage.getItem('productos');
            return productosLS ? JSON.parse(productosLS) : [];
        }

        function leerLS() {
            let productosLS = obtenerProductosLocalStorage();
            listaProductos.innerHTML = '';
            productosLS.forEach(function (producto) {
                const row = document.createElement("tr");
                row.innerHTML = `
                <td style="text-align: center;"><img src="${producto.imagen}" width="50" height="50"></td>
                <td style="text-align: center;">${producto.titulo}</td>
                <td style="text-align: center;">S/ ${parseFloat(producto.precio).toFixed(2)}</td>
                <td style="text-align: center;">${producto.cantidad}</td>
                <td style="text-align: center;">
                    <a href="#" class="borrar-producto" data-id="${producto.id}">
                        <span class="fas fa-trash-can" style="color: red"></span>
                    </a>
                </td>
            `;
                listaProductos.appendChild(row);
            });
            actualizarNumeroProductos(); // Actualiza el número de productos al cargar el carrito
        }

        function eliminarProducto(e) {
            if (e.target.classList.contains('fa-trash-can')) {
                const productoId = e.target.closest('a').getAttribute('data-id');
                e.target.closest('tr').remove();
                eliminarProductoLocalStorage(productoId);
                actualizarNumeroProductos(); // Actualiza el número de productos después de eliminar
            }
        }

        function eliminarProductoLocalStorage(id) {
            let productosLS = obtenerProductosLocalStorage();
            productosLS = productosLS.filter(producto => producto.id !== id);
            localStorage.setItem('productos', JSON.stringify(productosLS));
        }

        function vaciarCarrito() {
            listaProductos.innerHTML = '';
            localStorage.removeItem('productos');
            actualizarNumeroProductos(); // Actualiza el número de productos al vaciar el carrito
        }

        function actualizarNumeroProductos() {
            let productosLS = obtenerProductosLocalStorage(); // Obtener los productos del localStorage
            numeroProductos.textContent = productosLS.length; // Número de productos únicos
        }

        // Ajustar la función insertarProducto para evitar duplicados y actualizar el contador
        function insertarProducto(producto) {
            let productosLS = obtenerProductosLocalStorage();

            // Verificar si el producto ya existe en el carrito
            const existe = productosLS.some(p => p.id === producto.id);

            if (!existe) {
                // Si no existe, agregar al carrito
                productosLS.push(producto);
                localStorage.setItem('productos', JSON.stringify(productosLS));

                // Crear una fila en la tabla del carrito
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td style="text-align: center;"><img src="${producto.imagen}" width="50"></td>
                    <td style="text-align: center;">${producto.titulo}</td>
                    <td style="text-align: center;">S/ ${producto.precio}</td>
                    <td style="text-align: center;">${producto.cantidad}</td>
                    <td style="text-align: center;">
                        <a href="#" class="borrar-producto" data-id="${producto.id}">
                            <span class="fas fa-trash-can" style="color: red"></span>
                        </a>
                    </td>
                `;
                listaProductos.appendChild(row);
            } else {
                alert("Este producto ya está en el carrito.");
            }

            // Actualizar el número de productos únicos y el total
            actualizarNumeroProductos();
        }

    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

</body>

</html>