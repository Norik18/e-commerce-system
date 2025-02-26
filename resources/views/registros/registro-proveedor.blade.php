<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Registro</title>

    <style>
        * {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            min-height: 100vh;
            background-image: url('https://wallpapers.com/images/hd/e-commerce-1900-x-1118-wallpaper-r2k1ldol65vss423.jpg');
            background-position: center;
            background-size: cover;
        }

        .contenedor {
            position: relative;
            width: 500px;
            /* Aumentado a 500px */
            border: 2px solid rgba(255, 255, 255, .6);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            padding: 30px;
            /* Agregado padding */
            display: flex;
            flex-direction: column;
            /* Alineación vertical */
        }

        .contenedor h2 {
            font-size: 2.5rem;
            /* Aumentado a 2.5rem */
            color: #fff;
            text-align: center;
        }

        .input-contenedor {
            position: relative;
            margin: 20px 0;
            /* Ajustado para más espacio entre los campos */
            width: 100%;
            border-bottom: 2px solid #fff;
            /* Cambiado a 100% para usar todo el ancho del contenedor */
        }

        input:-webkit-autofill {
            background-color: transparent !important;
            color: #fff !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        input:-webkit-autofill::first-line {
            color: #fff !important;
        }

        /* Asegurar que el texto autocompletado sea blanco para diferentes navegadores */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            color: #fff !important;
            -webkit-text-fill-color: #fff !important;
            /* Cambia el color de relleno del texto autocompletado */
            background-color: transparent !important;
        }

        .input-contenedor label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: #fff;
            font-size: 1rem;
            pointer-events: none;
            transition: .6s;
            font-weight: bold;
        }

        input:focus~label,
        input:valid~label {
            top: -5px;
        }

        .input-contenedor input {
            width: 100%;
            height: 60px;
            /* Aumentado a 60px */
            background-color: transparent;
            border: none;
            outline: none;
            font-size: 1rem;
            padding: 10px 0 5px;
            /* Ajustado el padding */
            color: #fff;
        }

        .input-contenedor i {
            position: absolute;
            color: #fff;
            font-size: 1.6rem;
            top: 19px;
            right: 10px;
            /* Ajustado para un poco más de espacio */
        }

        button {
            width: 100%;
            height: 50px;
            /* Aumentado a 50px */
            border-radius: 25px;
            /* Ajusta el valor para redondear más o menos */
            background: #007bff;
            /* Color de fondo del botón */
            border: none;
            font-weight: bold;
            cursor: pointer;
            outline: none;
            font-size: 1rem;
            transition: .4s;
        }

        button:hover {
            opacity: .9;
        }


        .registrar {
            font-size: .9rem;
            /* Aumentado para mejor visibilidad */
            color: #fff;
            text-align: center;
            margin: 20px 0 10px;
        }

        .registrar p a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: .3s;
        }

        .registrar p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <section>
        <div class="contenedor">
            <div class="formulario">
                <form action="{{ route('proveedores.create') }}" method="POST">
                    @csrf
                    <h2 class="text-center">Ser proveedor</h2>
                    <div class="col-md-12 input-contenedor mt-0">
                        <i class="fa-solid fa-file-alt"></i>
                        <input type="text" name="ruc" required>
                        <label for="ruc">RUC</label>
                    </div>
                    <div class="col-md-12 input-contenedor mt-0">
                        <i class="fa-solid fa-building"></i>
                        <input type="text" name="nombre_empresa" required>
                        <label for="nombre_empresa">Nombre de la Empresa</label>
                    </div>
                    <div class="col-md-12 input-contenedor mt-0">
                        <i class="fa-solid fa-phone"></i>
                        <input type="text" name="telefono" required>
                        <label for="telefono">Teléfono</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                </form>

                <div class="registrar text-center mt-3">
                    <p>Ya tengo Cuenta <a href="#">Iniciar Sesión</a></p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>