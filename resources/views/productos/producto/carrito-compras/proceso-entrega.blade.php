@extends('layout/navbar-compra')

@section("TituloPagina", "Proceso de Entrega")

@section('contenido')

<div class="container mt-5">
    <!-- Barra de progreso -->
    <div class="entrega-progress-container mt-5">
        <div class="entrega-progress-step active">1<br>Carro</div>
        <div class="entrega-progress-bar-custom">
            <div class="entrega-progress-bar-fill"></div>
        </div>
        <div class="entrega-progress-step active">2<br>Entrega</div>
        <div class="entrega-progress-bar-custom"></div>
        <div class="entrega-progress-step">3<br>Pago</div>
    </div>

    <!-- Paso 2: Entrega -->
    <div class="delivery-container mt-4">
        <h5 class="mb-4">Elige un tipo de entrega</h5>

        <!-- Opción 1: Retiro en tienda (Deshabilitada) -->
        <div class="delivery-option disabled">
            <div class="delivery-text">
                <strong>Retira tu pedido</strong>
                <p class="text-muted mb-0">No disponible <a href="#" class="text-decoration-none">¿Por qué?</a></p>
            </div>
        </div>

        <!-- Opción 2: Envío Express -->
        <div class="delivery-option" data-bs-toggle="modal" data-bs-target="#modalDomicilio">
            <div class="delivery-icon">🚀</div>
            <div class="delivery-text">
                <strong>Envío Express</strong>
                <p class="text-muted mb-0">Ingresa tu dirección para continuar</p>
            </div>
        </div>

        <!-- Opción 3: Envío en Fecha Programada -->
        <div class="delivery-option" data-bs-toggle="modal" data-bs-target="#modalDomicilio">
            <div class="delivery-icon">📅</div>
            <div class="delivery-text">
                <strong>Envío en fecha programada</strong>
                <p class="text-muted mb-0">Ingresa tu dirección para continuar</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Dirección de Envío -->
<div class="modal fade" id="modalDomicilio" tabindex="-1" role="dialog" aria-labelledby="modalDomicilioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg"> <!-- Aumenté el radio de borde para ser más redondeado -->
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="modalDomicilioLabel">Datos de Envío a Domicilio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Formulario de Envío -->
            <form action="{{ route('guardar-envio', ['id_pedido' => $id_pedido]) }}" method="POST">
                @csrf
                <input type="hidden" name="id_pedido" value="{{ $id_pedido }}"> 
                <div class="modal-body">
                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-6">
                            <div class="mb-3 redondeo">
                                <label for="departamento" class="form-label">Departamento</label>
                                <select class="form-select rounded-3" id="departamento" name="departamento" required>
                                    <option selected disabled>Selecciona un Departamento</option>
                                    <option value="Amazonas">🌳 Amazonas</option>
                                    <option value="Ancash">🏔️ Áncash</option>
                                    <option value="Apurímac">🏞️ Apurímac</option>
                                    <option value="Arequipa">🏙️ Arequipa</option>
                                    <option value="Ayacucho">🌄 Ayacucho</option>
                                    <option value="Cajamarca">🌾 Cajamarca</option>
                                    <option value="Callao">⚓ Callao</option>
                                    <option value="Cusco">🏛️ Cusco</option>
                                    <option value="Huancavelica">⛰️ Huancavelica</option>
                                    <option value="Huánuco">🌿 Huánuco</option>
                                    <option value="Ica">🌵 Ica</option>
                                    <option value="Junín">🌲 Junín</option>
                                    <option value="La Libertad">🏖️ La Libertad</option>
                                    <option value="Lambayeque">🌻 Lambayeque</option>
                                    <option value="Lima">🏙️ Lima</option>
                                    <option value="Loreto">🌳 Loreto</option>
                                    <option value="Madre de Dios">🌿 Madre de Dios</option>
                                    <option value="Moquegua">🏞️ Moquegua</option>
                                    <option value="Pasco">🏔️ Pasco</option>
                                    <option value="Piura">🏖️ Piura</option>
                                    <option value="Puno">🏞️ Puno</option>
                                    <option value="San Martín">🌱 San Martín</option>
                                    <option value="Tacna">🌄 Tacna</option>
                                    <option value="Tumbes">🌴 Tumbes</option>
                                    <option value="Ucayali">🌳 Ucayali</option>
                                </select>
                            </div>

                            <div class="mb-3 redondeo">
                                <label for="provincia" class="form-label">Provincia</label>
                                <select class="form-select rounded-3" id="provincia" name="provincia" required>
                                    <option selected disabled>Selecciona una Provincia</option>
                                    <option value="Lima">🏙️ Lima</option>
                                    <option value="Barranca">🌊 Barranca</option>
                                    <option value="Cañete">🏖️ Cañete</option>
                                    <option value="Callao">⚓ Callao</option>
                                    <option value="Huaral">🏞️ Huaral</option>
                                    <option value="Huarochirí">🌳 Huarochirí</option>
                                    <option value="Canta">⛰️ Canta</option>
                                    <option value="Cayetano Heredia">🏙️ Cayetano Heredia</option>
                                    <option value="Yauyos">🏞️ Yauyos</option>
                                </select>
                            </div>

                            <div class="mb-3 redondeo">
                                <label for="distrito" class="form-label">Distrito</label>
                                <select class="form-select rounded-3" id="distrito" name="distrito" required>
                                    <option selected disabled>Selecciona un Distrito</option>
                                    <option value="Ate">🏙️ Ate</option>
                                    <option value="Barranco">🌅 Barranco</option>
                                    <option value="Breña">🏙️ Breña</option>
                                    <option value="Carabayllo">🏘️ Carabayllo</option>
                                    <option value="Chaclacayo">🌳 Chaclacayo</option>
                                    <option value="Chorrillos">🏖️ Chorrillos</option>
                                    <option value="Cercado de Lima">🏙️ Cercado de Lima</option>
                                    <option value="Comas">🏙️ Comas</option>
                                    <option value="El Agustino">🏙️ El Agustino</option>
                                    <option value="Independencia">🏙️ Independencia</option>
                                    <option value="La Molina">🌲 La Molina</option>
                                    <option value="La Victoria">🏙️ La Victoria</option>
                                    <option value="Lince">🏙️ Lince</option>
                                    <option value="Magdalena del Mar">🌊 Magdalena del Mar</option>
                                    <option value="Miraflores">🏖️ Miraflores</option>
                                    <option value="Pueblo Libre">🏙️ Pueblo Libre</option>
                                    <option value="San Borja">🌳 San Borja</option>
                                    <option value="San Isidro">🏙️ San Isidro</option>
                                    <option value="San Juan de Lurigancho">🏙️ San Juan de Lurigancho</option>
                                    <option value="San Juan de Miraflores">🏙️ San Juan de Miraflores</option>
                                    <option value="San Luis">🌳 San Luis</option>
                                    <option value="San Martín de Porres">🏙️ San Martín de Porres</option>
                                    <option value="San Miguel">🏙️ San Miguel</option>
                                    <option value="Santiago de Surco">🌳 Santiago de Surco</option>
                                    <option value="Surquillo">🏙️ Surquillo</option>
                                    <option value="Villa El Salvador">🏠 Villa El Salvador</option>
                                    <option value="Villa María del Triunfo">🏙️ Villa María del Triunfo</option>
                                </select>
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-6">
                            <div class="mb-3 redondeo">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control rounded-3" id="direccion" name="direccion" placeholder="Ingresa tu dirección" required>
                            </div>

                            <div class="mb-3 redondeo">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control rounded-3" id="telefono" name="telefono" placeholder="Ingresa tu teléfono" required>
                            </div>

                            <div class="mb-3 redondeo">
                                <label for="instrucciones" class="form-label">Instrucciones adicionales</label>
                                <textarea class="form-control rounded-3" id="instrucciones" name="instrucciones" placeholder="Ejemplo: Timbre malogrado"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary rounded-3">Continuar a Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Aseguramos bordes redondeados en todo el modal */
    .modal-content {
        border-radius: 15px;
        /* Bordes del modal redondeados */
    }

    /* Para que la cabecera y pie del modal también tengan bordes redondeados */
    .modal-header,
    .modal-footer {
        border-radius: 15px 15px 0 0;
        /* Solo la parte superior redondeada */
    }

    /* Ajuste de tamaño del modal para que sea como una card */
    .modal-dialog {
        max-width: 600px;
        /* Un tamaño más pequeño, parecido a una card */
    }

    .modal-body {
        padding: 20px;
    }

    /* Estilo de los botones */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .redondeo {
        border-radius: 50px;
    }

    /* Añadir un poco de sombra en el modal para darle profundidad */
    .modal-content {
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        /* Sombra suave */
    }
</style>

@endsection