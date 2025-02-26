@extends('layout/navbar-compra')

@section("TituloPagina", "Proceso de Pago")

@section('contenido')
<div class="container mt-5">
    <!-- Barra de progreso -->
    <div class="pago-progress-container mt-5">
        <div class="pago-progress-step active">1<br>Carro</div>
        <div class="pago-progress-bar-custom">
            <div class="pago-progress-bar-fill"></div>
        </div>
        <div class="pago-progress-step active">2<br>Entrega</div>
        <div class="pago-progress-bar-custom">
            <div class="pago-progress-bar-fill"></div>
        </div>
        <div class="pago-progress-step active">3<br>Pago</div>
    </div>

    <div class="row">
        <!-- Formulario de pago -->
        <div class="col-md-8">
            <h5 class="mb-3">Método de Pago</h5>
            <div class="card p-3 mb-3">
                <input type="radio" id="tarjeta-cmr" name="payment" class="form-check-input me-2"
                    onclick="habilitarBoton()">
                <label for="tarjeta-cmr" class="form-check-label">Tarjeta CMR</label>
            </div>
            <div class="card p-3 mb-3">
                <input type="radio" id="tarjeta-credito" name="payment" class="form-check-input me-2"
                    onclick="habilitarBoton()">
                <label for="tarjeta-credito" class="form-check-label">Tarjeta de crédito</label>
            </div>
            <div class="card p-3 mb-3">
                <input type="radio" id="debito-falabella" name="payment" class="form-check-input me-2"
                    onclick="habilitarBoton()">
                <label for="debito-falabella" class="form-check-label">Débito Banco Falabella</label>
            </div>
            <div class="card p-3 mb-3">
                <input type="radio" id="tarjeta-debito" name="payment" class="form-check-input me-2"
                    onclick="habilitarBoton()">
                <label for="tarjeta-debito" class="form-check-label">Tarjeta de débito</label>
            </div>
        </div>

        <!-- Resumen de compra -->
        <div class="col-md-4">
            <h5 class="mb-3">Resumen de la compra</h5>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Productos (<span id="productos-count">0</span>)</span>
                    <strong id="productos-total">S/ 0.00</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Descuentos (<span id="descuentos-count">0</span>)</span>
                    <strong id="descuentos-total" class="text-danger">- S/ 0.00</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong id="resumen-total">S/ 0.00</strong>
                </li>
            </ul>
            <button class="btn btn-primary w-100 mb-3" id="btnContinuar" disabled
                onclick="realizarCompra()">Continuar</button>
            <button class="btn btn-outline-secondary w-100 mb-3">¿Necesitas factura?</button>
            <form id="formCompra" action="{{ route('realizar-compra') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="productos" id="productos">
                <input type="hidden" name="total" id="totalCompra">
            </form>
            <div class="form-check mb-2">
                <input type="checkbox" class="form-check-input" id="terms-cmr">
                <label for="terms-cmr" class="form-check-label">
                    Acepto los <a href="#">términos y condiciones</a> para acceder al programa CMR puntos.
                </label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="terms-privacy" onchange="habilitarBoton()">
                <label for="terms-privacy" class="form-check-label">
                    Declaro que he leído y aceptado los <a href="#">términos y condiciones</a> y autorizo la <a
                        href="#">política de privacidad</a>.
                </label>
            </div>
        </div>
    </div>
</div>

<script>
    // Recupera datos del carrito desde LocalStorage
    function cargarResumenDeCompra() {
        const productosLS = JSON.parse(localStorage.getItem('productos')) || [];
        const descuentoPorcentaje = 10; // Porcentaje de descuento
        const limiteDescuento = 100; // Límite para aplicar descuento
        let cantidadProductos = 0;
        let totalCarrito = 0;

        productosLS.forEach(producto => {
            cantidadProductos += parseInt(producto.cantidad);
            totalCarrito += parseFloat(producto.precio) * parseInt(producto.cantidad);
        });

        let descuentoTotal = totalCarrito > limiteDescuento ? totalCarrito * (descuentoPorcentaje / 100) : 0;
        let totalConDescuento = totalCarrito - descuentoTotal;

        // Actualiza el DOM
        document.querySelector('#productos-count').textContent = cantidadProductos;
        document.querySelector('#productos-total').textContent = `S/ ${totalCarrito.toFixed(2)}`;
        document.querySelector('#descuentos-count').textContent = descuentoTotal > 0 ? 1 : 0;
        document.querySelector('#descuentos-total').textContent = `-S/ ${descuentoTotal.toFixed(2)}`;
        document.querySelector('#resumen-total').textContent = `S/ ${totalConDescuento.toFixed(2)}`;
    }

    // Habilita botón de continuar
    function habilitarBoton() {
        const termsChecked = document.getElementById('terms-privacy').checked;
        const paymentSelected = document.querySelector('input[name="payment"]:checked');
        const btnContinuar = document.getElementById('btnContinuar');
        btnContinuar.disabled = !(termsChecked && paymentSelected);
    }

    function realizarCompra() {
        const productosLS = JSON.parse(localStorage.getItem('productos')) || [];
        const totalCarrito = parseFloat(document.querySelector('#resumen-total').textContent.replace('S/ ', ''));

        // Preparar los datos para enviar
        const productos = productosLS.map(producto => ({
            id: producto.id,
            cantidad: producto.cantidad,
            precio: producto.precio
        }));

        // Asignar los productos y el total al formulario oculto
        document.getElementById('productos').value = JSON.stringify(productos);
        document.getElementById('totalCompra').value = totalCarrito.toFixed(2);

        // Enviar el formulario de compra
        document.getElementById('formCompra').submit();
    }


    document.addEventListener('DOMContentLoaded', () => {
        cargarResumenDeCompra();
    });
</script>
@endsection