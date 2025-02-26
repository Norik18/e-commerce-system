@extends('layout/navbar')

@section("TituloPagina", "Ubicación")

@section('contenido')

<div class="container">
    <h1>Ubicación de nuestra tienda</h1>
    <p>Encuéntranos en la siguiente dirección:</p>
    <p><strong>Dirección:</strong>X6JQ+GF2, 28 De Julio 104, Ica 11004</p>

    <!-- Google Maps -->
    <div style="width: 100%; height: 400px;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.4929441725347!2d-75.7615648034893!3d-14.019362201171118!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zLTQxLCAxOTMgMzYyIC03NSwgNzYx!5e0!3m2!1ses-419!2spe!4v1690246028123!5m2!1ses-419!2spe"
            width="100%"
            height="400"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>

    <p>
        <a href="https://www.google.com/maps?q=-14.01954416849637,-75.76157669538918" target="_blank">
            Ver en Google Maps
        </a>
    </p>
</div>

@include('layout.footer')

@endsection