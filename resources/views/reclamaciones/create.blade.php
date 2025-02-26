@extends('layout/navbar')

@section("TituloPagina", "Reclamaciones")

@section('contenido')

<div class="container mt-4">
    <h2 class="text-primary">Datos Personales</h2>
    <hr class="text-warning">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reclamaciones.store') }}" method="POST">
        @csrf
        <!-- Primera fila -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="tipo_documento">Tipo de Documento</label>
                <select name="tipo_documento" id="tipo_documento" class="form-control">
                    <option value="DNI">DNI</option>
                    <option value="Pasaporte">Pasaporte</option>
                    <option value="CE">Carné de Extranjería</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="numero_documento">Nro. Documento</label>
                <input type="text" name="numero_documento" id="numero_documento" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" required>
            </div>
        </div>

        <!-- Segunda fila -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres" id="nombres" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="apoderado">Datos del Apoderado (Padre o Madre)</label>
                <input type="text" name="apoderado" id="apoderado" class="form-control"
                    placeholder="Opcional , en caso de ser menor de edad">
            </div>
        </div>

        <!-- Dirección -->
        <div class="row mb-3">
            <div class="col-md-8">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="dreccion" class="form-control" required
                    placeholder="Calle/Av/Jr/Nro/Mz/Lote">
            </div>
            <div class="col-md-4">
                <label for="urbanizacion">Urbanización</label>
                <input type="text" name="urbanizacion" id="urbanizacion" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="departamento">Departamento</label>
                <input type="text" name="departamento" id="departamento" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia" id="provincia" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="distrito">Distrito</label>
                <input type="text" name="distrito" id="distrito" class="form-control" required>
            </div>
        </div>

        <!-- Contacto -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="celular">Celular</label>
                <input type="text" name="celular" id="celular" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="correo">Correo Electrónico</label>
                <input type="email" name="correo_electronico" id="correo" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="medio_respuesta">Medio de Respuesta</label>
                <select name="medio_respuesta" id="medio_respuesta" class="form-control" required>
                    <option value="Correo electrónico">Correo electrónico</option>
                    <option value="Teléfono">Teléfono</option>
                    <option value="Celular">Celular</option>
                    <option value="Entrega a domicilio">Entrega a domicilio</option>
                </select>
                <span class="select-arrow"><i class="bi bi-chevron-down"></i></span>
            </div>
        </div>

        <!-- Bien contratado -->
        <h2 class="text-primary mt-4">Bien Contratado</h2>
        <hr class="text-warning">
        <div class="row mb-3">
            <div class="col-md-6">
                <label><input type="checkbox" name="tipo_bien[]" value="Producto"> Producto</label>
            </div>
            <div class="col-md-6">
                <label><input type="checkbox" name="tipo_bien[]" value="Servicio"> Servicio</label>
            </div>
            <div class="form-group">
                <label for="descripcion_bien">Descripción del Bien</label>
                <textarea name="descripcion_bien" id="descripcion_bien" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="monto_reclamado">Monto Reclamado S/</label>
                <input type="number" name="monto_reclamado" id="monto_reclamado" class="form-control">
            </div>
        </div>

        <!-- Reclamo -->
        <h2 class="text-primary mt-4">Datos del Reclamo / Queja</h2>
        <hr class="text-warning">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="motivo_contacto">Motivo de Contacto</label>
                <select name="motivo_contacto" id="motivo_contacto" class="form-control">
                    <option value="Queja">Queja</option>
                    <option value="Reclamo">Reclamo</option>
                </select>
                <span class="select-arrow"><i class="bi bi-chevron-down"></i></span>
            </div>
            <div class="col-md-6">
                <label for="motivo_reclamo">Motivo del Reclamo / Queja</label>
                <input type="text" name="motivo_reclamo" id="motivo_reclamo" class="form-control" required>
            </div>
            <div style="margin: 8px;">
                <p style="margin: 1px;">
                    <strong>Reclamo:</strong> Disconformidad relacionada al producto o servicio.
                </p>
                <p style="margin: 1px">
                    <strong>Queja:</strong> Disconformidad no relacionada a los productos o servicios. Malestar o
                    descontento respecto a la atención al público.
                </p>
            </div>
        </div>
        <div class="form-group">
            <label for="detalle">Detalle</label>
            <textarea name="detalle" id="detalle" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="pedido">Pedido</label>
            <textarea name="pedido" id="pedido" class="form-control" rows="3" required></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-warning btn-block">Enviar</button>
        </div>

        <div style="padding-top:30px ; padding-bottom:20px">
            <p><strong>Estimado Cliente, muchas gracias por registrar su incidencia en el Libro de Reclamaciones, su
                    opinion es muy importante para nosotros.</strong></p>

            <p><strong>"La firma del colaborador en la presente hoja de reclamación, expresa únicamente la recepción
                    de la misma, más no la aceptación de su contenido. La presente reclamación será tramitada dentro
                    del plazo de ley."</strong></p>

            <p><strong>"Nuestra área de servicio al Cliente le informa: (i) La formulación del reclamo no impide
                    acudir a otras vías de solución de controversias ni es

                    requisito previo para interponer una denuncia ante el INDECOPI.

                    (ii) El proveedor debe dar respuesta al reclamo o queja en un plazo no mayor a quince (15) días
                    hábiles, el cual es improrrogable.</strong></p>
        </div>
    </form>
</div>

@include('layout.footer')

<style>
    /* Estilo para el texto del placeholder */

    input::placeholder,

    textarea::placeholder {

        color: rgba(0, 0, 0, 0.4);
        /* Color con transparencia */

        font-style: italic;
        /* Opcional: estilo cursivo */

    }



    /* Asegurarse de que el placeholder tome prioridad */

    input.form-control::placeholder {

        color: rgba(0, 0, 0, 0.4) !important;
        /* Forzamos el cambio */

    }













    /* Contenedor para el select */

    .select-container {

        position: relative;

        display: inline-block;

        width: 100%;

    }



    /* Estilo para el select */

    #medio_respuesta {

        -webkit-appearance: none;
        /* Elimina la flecha predeterminada de los navegadores webkit */

        -moz-appearance: none;
        /* Elimina la flecha en Firefox */

        appearance: none;
        /* Elimina la flecha en otros navegadores */

        padding-right: 20px;
        /* Espacio para la flecha personalizada */

    }



    /* Estilo de la flecha */

    .select-arrow {

        position: absolute;

        top: 40%;

        right: 20px;

        transform: translateY(50%);

        pointer-events: none;
        /* Asegura que la flecha no interfiera con la interacción del select */

    }



    /* Flecha en el select cuando se hace foco */

    #medio_respuesta:focus {

        outline: none;
        /* Elimina el borde de enfoque */

    }
</style>

@endsection