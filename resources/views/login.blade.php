<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Log - in</title>
    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
</head>

<body>
    @if (session('success'))    
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    <section>
        <div class="contenedor">
            <div class="formulario">
                <form action="{{route('login.show')}}" method="POST">
                    @csrf
                    <h2>Inicio Sesión</h2>

                    <div class="input-contenedor">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" name="usuario" required>
                        <label for="">Usuario</label>
                    </div>

                    <div class="input-contenedor">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="clave" required>
                        <label for="">Contraseña</label>
                    </div>

                    <div class="olvidar">
                        <label for="">
                            <a href="">Olvidé mi contraseña</a>
                        </label>
                    </div>

                    <button type="submit">Acceder</button>
                </form>
                <div>
                    <div class="registrar">
                        <a href="{{route('registro.index')}}">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>