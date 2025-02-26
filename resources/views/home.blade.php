@extends('layout/navbar')

@section("TituloPagina", "Home")

@section('contenido')

<!-- ALERTA -->
@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<!-- UBICACION DE RETIRO DE PRODUCTOS----------------------------------- -->
<div class="retira-productos">
  <div class="icon-container">
    <i class="bi bi-shop"></i> <!-- Icono de tienda local -->
  </div>
  <div class="text-container">
    <p><strong>Retira tus productos Gratis</strong> en más de <strong>200 puntos</strong> a Nivel Nacional
      <a href="{{ route('ubicacion.index') }}" class="btn-link">Ver Tiendas</a>
    </p>
  </div>
</div>

<!-- IMAGENES DEL BANNER-------------------------------------------------------------- -->
<div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
  <!-- Indicadores -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active" aria-current="true"
      aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
  </div>

  <!-- Imágenes con enlaces -->
  <div class="carousel-inner">
    <!-- Banner 1 -->
    <div class="carousel-item active">
      <a href="https://www.tu-enlace1.com" target="_blank">
        <img src="https://www.efe.com.pe/media/wysiwyg/efe-slider-b2c-021224-07-01_1.png" class="d-block w-100"
          alt="Banner 1">
      </a>
    </div>

    <!-- Banner 2 -->
    <div class="carousel-item">
      <a href="https://www.tu-enlace2.com" target="_blank">
        <img src="https://www.efe.com.pe/media/wysiwyg/efe-slider-b2c-021224-03-01_1_.png" class="d-block w-100"
          alt="Banner 2">
      </a>
    </div>

    <!-- Banner 3 -->
    <div class="carousel-item">
      <a href="https://www.tu-enlace3.com" target="_blank">
        <img src="https://www.efe.com.pe/media/wysiwyg/efe-slider-b2c-021224-remate-11-01_2.png" class="d-block w-100"
          alt="Banner 3">
      </a>
    </div>

    <!-- Banner 4 -->
    <div class="carousel-item">
      <a href="https://www.tu-enlace4.com" target="_blank">
        <img src="https://www.efe.com.pe/media/wysiwyg/efe-slider-b2c-021224-01-01_1.png" class="d-block w-100"
          alt="Banner 4">
      </a>
    </div>

    <!-- Banner 5 -->
    <div class="carousel-item">
      <a href="https://www.tu-enlace5.com" target="_blank">
        <img src="https://www.efe.com.pe/media/wysiwyg/efe-slider-b2c-021224-06-01.png" class="d-block w-100"
          alt="Banner 5">
      </a>
    </div>
  </div>

  <!-- Controles -->
  <button class="carousel-control-prev custom-nav" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next custom-nav" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

<section class="benefits-section">
  <h2 class="benefits-title">Nuestros Beneficios</h2>
  <div class="benefits">
    <img src="https://www.efe.com.pe/media/wysiwyg/efe-cintillos-3a_2.jpg" alt="">
  </div>
  <div class="benefits-container">
    <!-- Aquí puedes agregar las imágenes -->
    <img src="https://www.efe.com.pe/media/wysiwyg/cupon-efe-efectiva150_1_.png" alt="Beneficio 1"
      class="benefit-image">
    <img src="https://www.efe.com.pe/media/wysiwyg/IMG_9240.png" alt="Beneficio 2" class="benefit-image">
    <img src="https://www.efe.com.pe/media/wysiwyg/cupon-efe-cencosud_1.png" alt="Beneficio 3" class="benefit-image">
    <img src="https://www.efe.com.pe/media/wysiwyg/efe-cup_n-bancos-220724.png" alt="Beneficio 3" class="benefit-image">
  </div>

  <section class="categories">
    <h2 class="categories-title">Los más destacados <span>🔥</span> de nuestras categorías</h2>
    <div class="categories-grid">
      <div class="category-item">
        <img src="https://oechsle.vteximg.com.br/arquivos/masdestacado_021224_04.jpg" alt="Dermocosmética">
      </div>
      <div class="category-item">
        <img src="https://oechsle.vteximg.com.br/arquivos/masdestacado_021224_20.jpg" alt="Fragancias">
      </div>
      <div class="category-item">
        <!-- Enlace para redirigir al ID de la categoría -->
        <a href="{{ route('productos.index', ['categoria' => 5]) }}">
          <!-- Aquí ponemos directamente el ID de la categoría "ropa_deportiva" -->
          <img src="https://oechsle.vteximg.com.br/arquivos/masdestacado_021224_08.jpg" alt="Ropa deportiva">
        </a>
      </div>
      <div class="category-item">
        <img src="https://oechsle.vteximg.com.br/arquivos/masdestacado_021224_21.jpg" alt="Lentes de sol">
      </div>
      <div class="category-item">
        <img src="https://oechsle.vteximg.com.br/arquivos/masdestacado_021224_18_a.jpg" alt="Bicicletas">
      </div>
      <div class="category-item">
        <img src="https://oechsle.vteximg.com.br/arquivos/masdestacado_021224_09.jpg" alt="Sandalias">
      </div>
      <div class="category-item">
        <img src="https://oechsle.vteximg.com.br/arquivos/masdestacado_021224_01.jpg" alt="Ropa deportiva">
      </div>
      <div class="category-item">
        <img src="https://oechsle.vteximg.com.br/arquivos/masdestacado_021224_19_a.jpg" alt="Zapatillas deportivas">
      </div>
    </div>
  </section>
  <div>
    <h2 class="benefits-title">Regalos para toda la familia</h2>
    <img src="https://www.efe.com.pe/media/wysiwyg/banner-navidad-efe_2.png" alt="regalos" class="gift-image">
    <img src="https://www.efe.com.pe/media/wysiwyg/INSTALACI_N-EFE-2366.160.jpeg" alt="regalos" class="gift-image">
  </div>
</section>

<section class="horizontal-categories">
  <h2 class="horizontal-categories-title">Categorías</h2>
  <div class="horizontal-categories-list">
    <div class="horizontal-category-item">
      <a href="#">
        <img src="{{ asset('img/electrodomestico.png') }}" alt="Electrodomésticos">
      </a>
      <p>Electrodomésticos</p>
    </div>
    <div class="horizontal-category-item">
      <a href="">
        <img src="{{ asset('img/technology.png') }}" alt="Tecnología">
      </a>
      <p>Tecnología</p>
    </div>
    <div class="horizontal-category-item">
      <a href="">
        <img src="{{ asset('img/sofa.png') }}" alt="muebles">
      </a>
      <p>Muebles</p>
    </div>
    <div class="horizontal-category-item">
      <a href="">
        <img src="{{asset(path: 'img/soccer.png')}}" alt="Deportes">
      </a>
      <p>Deportes</p>
    </div>
    <div class="horizontal-category-item">
      <a href="">
        <img src="{{asset(path: 'img/brand.png')}}" alt="Ropa">
      </a>
      <p>Ropa</p>
    </div>
  </div>
</section>

<div class="container my-5">
  <div class="row">
    <!-- Catálogo de productos -->
    <div class="col-12">
      <h1 class="section-title fs-2 text-dark">Catálogo de Productos</h1>
      <article>
        <div class="row">
          @foreach($productos as $producto)
        <div class="col-3">
        <div class="product-card" data-category="{{ strtolower($producto->categoria) }}">
          <a href="{{ route('productos.show', $producto->id_producto) }}" class="product-card-link">
          @if($producto->stock > 10)
        <div class="badge">-10%</div>
      @endif
          <div class="product-tumb">
            <img class="img-product mx-auto d-block"
            src="{{ route('productos-user.image', $producto->id_producto) }}" alt="Imagen del producto">
          </div>
          <div class="product-details">
            <span class="product-catagory">{{ $producto->categoria }}</span>
            <h6>{{ $producto->nombre_producto }}</h6>
            <div class="product-bottom-details">
            <div class="product-price">S/ {{ number_format($producto->precio, 2) }}</div>
            <div class="product-links">
              <a href=""><i class="fa fa-heart"></i></a>
            </div>
            </div>
          </div>
          </a>
        </div>
        </div>
      @endforeach
        </div>
      </article>
    </div>
  </div>
</div>

<style>
  /* Sección de categorías horizontales */

  .horizontal-categories {

    padding: 20px;

    background-color: #fff;

    max-width: 1200px;

    margin: 0 auto;

  }



  .horizontal-categories-title {

    font-size: 24px;

    font-weight: bold;

    color: #333;

    margin-bottom: 20px;

    text-align: center;

  }



  /* Lista de ítems en formato horizontal */

  .horizontal-categories-list {

    display: flex;

    justify-content: center;

    gap: 30px;

    /* Espacio entre ítems */

    flex-wrap: wrap;

    /* Permite que los ítems se ajusten si la pantalla es pequeña */

  }



  /* Cada ítem de categoría */

  .horizontal-category-item {

    display: flex;

    flex-direction: column;

    align-items: center;

    text-align: center;

    width: 100px;

    /* Ancho de cada ítem */

  }



  .horizontal-category-item img {

    width: 50px;

    /* Tamaño de los íconos */

    height: 50px;

    margin-bottom: 10px;

  }



  .horizontal-category-item p {

    font-size: 14px;

    color: #555;

    margin: 0;

  }



  /* styles.css */

  body {

    font-family: Arial, sans-serif;

    margin: 0;

    padding: 0;

    background-color: #f9f9f9;

    text-align: center;

    /* Centra el contenido */

  }



  .categories {

    padding: 20px;

    background-color: #fff;

    max-width: 1200px;

    margin: 0 auto;

  }



  .categories-title {

    font-size: 28px;

    font-weight: bold;

    color: #333;

    margin-bottom: 20px;

  }



  .categories-title span {

    color: red;

    font-size: 32px;

  }



  .categories-grid {

    display: grid;

    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));

    /* Ajusta el número de columnas según el espacio */

    gap: 20px;

    /* Espacio entre elementos */

  }



  .category-item {

    background-color: #f0f0f0;

    border-radius: 10px;

    overflow: hidden;

    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);

  }



  .category-item img {

    width: 100%;

    height: auto;

    display: block;

  }



  .category-item img {

    width: 100%;

    height: 100%;

    /* Se ajusta al tamaño completo del contenedor */

    object-fit: cover;

    /* Recorta la imagen para mantener la proporción */

  }













  /* +++++++++++++++++++++++++- */





  .products-grid {

    display: grid;

    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));

    /* Ajusta automáticamente el número de columnas */

    gap: 20px;

    /* Espacio entre los productos */

    padding: 20px;

  }



  .product {

    background-color: #fff;

    border-radius: 10px;

    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);

    overflow: hidden;

    text-align: center;

    padding: 10px;

  }



  .product img {

    width: 100%;

    /* La imagen ocupa todo el ancho del contenedor */

    height: auto;

    /* Mantiene la proporción de la imagen */

    border-radius: 10px;

    /* Bordes redondeados */

  }

















  .gift-image {

    max-width: 75%;

    padding-top: 20px;

    /* La imagen se adapta al contenedor */

    height: auto;

    /* Mantiene la proporción */

    border-radius: 10px;

    /* Bordes redondeados */

    box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.2);

    /* Sombra alrededor de la imagen */

  }



  .benefits {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 40px;
    background-color: #f0f0f0;
    border-radius: 8px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    padding: 40px;
    margin-bottom: 20px;
  }



  .benefits img {

    max-width: 80%;

    /* Se adapta al tamaño del contenedor */

    max-height: 60px;

    /* Limita la altura de la imagen */

    object-fit: contain;

    /* Mantiene la proporción de la imagen */

  }





  .benefits-section {

    padding: 30px;

    text-align: center;

  }



  .benefits-title {

    font-size: 24px;

    font-weight: bold;

    margin-bottom: 20px;

    color: #333;

  }





  .benefits-container {

    display: flex;

    justify-content: center;

    gap: 10px;

    overflow-x: auto;

    /* Scroll horizontal */

    padding-bottom: 50px;

  }



  .benefit-image {

    max-height: 150px;

    border-radius: 5px;

    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);

  }











  /* ubicacion de tiendas ---------------------------------- */

  .retira-productos {

    background-color: #002855;

    /* Azul oscuro */

    color: white;

    text-align: center;

    padding: 4px 20px;

    font-size: 18px;

    font-family: Arial, sans-serif;

    display: flex;

    /* Usamos flex para alinear los elementos */

    justify-content: center;

    /* Centrar todo */

    align-items: center;

    /* Centrar verticalmente */

    gap: 20px;

    /* Espacio entre icono y texto */



  }



  .icon-container {

    font-size: 30px;

    color: #ffffff;

    /* Color amarillo para el icono */

  }



  .text-container p {

    font-size: 20px;

    margin: 0;

  }



  .retira-productos strong {

    color: #f4d03f;

    /* Resaltar en amarillo */

  }



  .retira-productos .btn-link {

    color: white;

    text-decoration: underline;

    font-weight: bold;

    font-size: 14px;

    margin-top: 5px;

  }



  .retira-productos .btn-link:hover {

    color: #f4d03f;

    /* Cambia a amarillo al pasar el mouse */

  }







  /* Carrusel BANNER ------------------------------- */





  .carousel-caption {

    background: rgba(0, 0, 0, 0.5);

    /* Fondo semitransparente */

    padding: 15px;

    border-radius: 8px;

  }





  .custom-nav {

    position: absolute;

    top: 50%;

    transform: translateY(-50%);

    width: 40px;

    /* Ajusta el tamaño del área de clic */

    height: 40px;

    background-color: rgba(0, 0, 0, 0.5);

    /* Fondo semitransparente */

    border-radius: 50%;

  }



  .carousel-control-prev {

    left: 0;

    /* Coloca al límite izquierdo */

  }



  .carousel-control-next {

    right: 0;

    /* Coloca al límite derecho */

  }



  .carousel-control-prev-icon,

  .carousel-control-next-icon {

    background-size: 20px 20px;

    /* Tamaño de las flechas */

    filter: invert(1);

    /* Cambia el color a blanco */

  }

  /* NUESTRO BENEFICIOS */
</style>


<footer>
  @include('layout.footer')
</footer>

@endsection