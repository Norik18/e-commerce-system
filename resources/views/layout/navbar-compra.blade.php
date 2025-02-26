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

</head>

<body>

    <!-- Navegación -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="mx-auto">
                <a class="navbar-brand text-light" href="{{route('home.index')}}">
                    <img class="logo" src="{{ asset('img/logo-e-commerce.png') }}" alt="">
                </a>
            </div>
            <div class="compra-segura">
                <p>Compra 100% Segura<span class="fas fa-lock ms-2"></span></p>
            </div>  
        </nav>
    </header>

    <main>
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