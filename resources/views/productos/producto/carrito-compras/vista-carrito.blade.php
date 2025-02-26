@extends('layout/navbar-compra')

@section("TituloPagina", "Carrito de Compras")

@section('contenido')

<div class="container mt-5">
    <h2>Carrito</h2>
    <br>
    <div class="carrito-container">
        <!-- Lista de Productos -->
        <div class="productos-container" id="productos-carrito">
            <!-- Aquí se insertarán los productos dinámicamente -->
        </div>

        <!-- Resumen del pedido -->
        <div class="resumen-container">
            <h4>Resumen de la orden</h4>
            <div class="producto-precio">
                <p id="cantidad-productos">Productos (0):</p>
                <p id="subtotal-carrito">S/ 0.00</p>
            </div>
            <hr>
            <div class="producto-precio">
                <p>Descuento (0):</p>
                <p id="descuento" class="text-success">-S/ 0.00</p>
            </div>
            <hr>
            <div class="producto-total">
                <p class="total">Total: </p>
                <p id="total">S/ 0.00</p>
            </div>
            <div class="d-grid">
                <form action="{{ route('proceso-compra.index') }}" method="POST" id="formulario-carrito">
                    @csrf
                    <input type="hidden" name="productos" id="productos-input">
                    <input type="hidden" name="total" id="total-input">
                    <button type="submit" class="btn btn-continuar-compra btn-secondary mb-2" id="btn-continuar-compra" disabled>
                        Continuar compra
                    </button>
                </form>
                <a href="{{ route('productos.index') }}" class="btn btn-info btn-sm">Volver al catálogo</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para obtener los productos del LocalStorage
    function obtenerProductosLocalStorage() {
        let productosLS = localStorage.getItem('productos');
        return productosLS ? JSON.parse(productosLS) : [];
    }

    // Función para mostrar los productos en el carrito
    function mostrarProductosCarrito() {
        const productos = obtenerProductosLocalStorage();
        const contenedor = document.getElementById('productos-carrito');
        contenedor.innerHTML = ''; // Limpiar el contenedor antes de mostrar los nuevos productos
        let total = 0;

        productos.forEach(producto => {
            const productoDiv = document.createElement('div');
            productoDiv.classList.add('producto-item');
            productoDiv.innerHTML = `
                    <input type="checkbox" class="form-check-input me-3" checked>
                    <img src="${producto.imagen}" alt="${producto.titulo}">
                    <div class="producto-info">
                        <h5>${producto.titulo}</h5>
                        <p class="marca">Categoria: ${producto.categoria}</p>
                        <p class="vendedor">Vendedor: ${producto.username}</p>
                        <p class="mb-0">
                            <span class="precio">S/ ${parseFloat(producto.precio).toFixed(2)}</span>
                            <span class="precio-original">${producto.precioOriginal || ''}</span>
                        </p>
                        <span class="alert-stock">${producto.alertStock || ''}</span>
                    </div>
                    <div class="cantidad">
                        <div class="input-group input-group-sm">
                            <button type="button" class="btn btn-outline-secondary">-</button>
                            <input type="number" value="${producto.cantidad}" min="1" class="form-control">
                            <button type="button" class="btn btn-outline-secondary">+</button>
                        </div>      
                    </div>
                    <p class="max-unidad">Máx ${producto.maxUnidad || 1} unidad</p>
                `;
            contenedor.appendChild(productoDiv);

            total += parseFloat(producto.precio.replace('S/', '').replace('$', '')) * producto.cantidad;
        });

        // Actualizar total
        document.getElementById('total').textContent = `S/ ${total.toFixed(2)}`;
    }

    // Llamar la función cuando se carga la página
    document.addEventListener('DOMContentLoaded', mostrarProductosCarrito);

    // Constantes
    const descuentoPorcentaje = 10; // Porcentaje de descuento
    const limiteDescuento = 100; // Límite para aplicar descuento por producto

    function actualizarResumenOrden() {
        // Obtiene los productos del LocalStorage
        let productosLS = obtenerProductosLocalStorage();
        let cantidadProductosDistintos = productosLS.length; // Número de productos distintos
        let cantidadTotalProductos = 0; // Total de productos en el carrito
        let totalCarrito = 0; // Precio total antes de descuentos
        let descuentoTotal = 0; // Descuento acumulado

        // Calcula la cantidad total de productos y el total del carrito
        productosLS.forEach(producto => {
            cantidadTotalProductos += parseInt(producto.cantidad); // Asegura que sea un número
            const precioProductoTotal = parseFloat(producto.precio) * parseInt(producto.cantidad);
            totalCarrito += precioProductoTotal;
        });

        // Aplica descuento si el total supera el límite
        if (totalCarrito > limiteDescuento) {
            descuentoTotal = totalCarrito * (descuentoPorcentaje / 100);
        }

        // Total final después de aplicar el descuento
        const totalConDescuento = totalCarrito - descuentoTotal;

        // Actualiza los valores en el DOM
        document.querySelector('#subtotal-carrito').textContent = `S/ ${totalCarrito.toFixed(2)}`; // Total antes del descuento
        document.querySelector('#descuento').textContent = `-S/ ${descuentoTotal.toFixed(2)}`; // Descuento aplicado
        document.querySelector('#total').textContent = `S/ ${totalConDescuento.toFixed(2)}`; // Total con descuento

        // Actualiza la cantidad de productos y productos distintos
        const productosTexto = `Productos (${cantidadTotalProductos})`; // Cantidad total de productos
        const descuentoTexto = `Descuento (${cantidadProductosDistintos}):`; // Cantidad de productos distintos

        document.querySelector('#cantidad-productos').textContent = productosTexto;
        document.querySelector('#descuento').previousElementSibling.textContent = descuentoTexto;

        // Habilita o deshabilita el botón según la cantidad de productos
        const btnContinuarCompra = document.getElementById('btn-continuar-compra');
        if (cantidadTotalProductos > 0) {
            btnContinuarCompra.disabled = false;
        } else {
            btnContinuarCompra.disabled = true;
        }
    }

    // Asegúrate de llamar a esta función después de cargar la página y tras cualquier operación que modifique el carrito
    document.addEventListener('DOMContentLoaded', () => {
        actualizarResumenOrden();

        // Al enviar el formulario, agregar los productos y el total
        document.getElementById('formulario-carrito').addEventListener('submit', function(event) {
            const productos = obtenerProductosLocalStorage();
            document.getElementById('productos-input').value = JSON.stringify(productos);
            document.getElementById('total-input').value = parseFloat(document.getElementById('total').textContent.replace('S/ ', '').trim());
        });
    });

</script>

@endsection
