<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sidebar-user.css') }}?v={{ time() }}">
</head>

<body>

    <!-- Sidebar -->
    <sidebar>
        <nav class="py-3" id="navbar">
            <ul class="navbar-items flexbox-col">
                <li class="navbar-item flexbox-left">
                    <a href="{{route('perfil.index')}}" class="navbar-item-inner flexbox-left">
                        <div class="navbar-item-inner-icon-wrapper flexbox">
                            <span class="fa-solid fa-circle-user"></span>
                        </div>
                        <span class="link-text">Perfil</span>
                    </a>
                </li>
                <li class="navbar-item flexbox-left">
                    <a href="{{route('informes.index')}}" class="navbar-item-inner flexbox-left">
                        <div class="navbar-item-inner-icon-wrapper flexbox">
                            <span class="fa-solid fa-money-bill-trend-up"></span>
                        </div>
                        <span class="link-text">
                            @if(session('usuario.tipo_usuario') === 'Administrador' ||
                                session('usuario.tipo_usuario') === 'Proveedor')
                                Ventas
                            @else
                                Compras
                            @endif
                        </span>
                    </a>
                </li>
                <li class="navbar-item flexbox-left">
                    <a href="{{route('reclamaciones.index')}}" class="navbar-item-inner flexbox-left">
                        <div class="navbar-item-inner-icon-wrapper flexbox">
                            <span class="fa-solid fa-file-circle-exclamation"></span>
                        </div>
                        <span class="link-text">Reclamaciones</span>
                    </a>
                </li>
                @if(session('usuario.tipo_usuario') === 'Administrador' || session('usuario.tipo_usuario') === 'Proveedor')
                    <li class="navbar-item flexbox-left">
                        <a href="{{route('productos-user.index')}}" class="navbar-item-inner flexbox-left">
                            <div class="navbar-item-inner-icon-wrapper flexbox">
                                <span class="fa-solid fa-bag-shopping"></span>
                            </div>
                            <span class="link-text">Productos</span>
                        </a>
                    </li>
                    <li class="navbar-item flexbox-left">
                        <a href="{{route('dashboard.index')}}" class="navbar-item-inner flexbox-left">
                            <div class="navbar-item-inner-icon-wrapper flexbox">
                                <span class="fa-solid fa-chart-pie"></span>
                            </div>
                            <span class="link-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="navbar-item flexbox-left">
                        <a href="{{route('inventario.index')}}" class="navbar-item-inner flexbox-left">
                            <div class="navbar-item-inner-icon-wrapper flexbox">
                                <span class="fa-solid fa-boxes-stacked"></span>
                            </div>
                            <span class="link-text">Inventario</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </sidebar>

</body>

</html>