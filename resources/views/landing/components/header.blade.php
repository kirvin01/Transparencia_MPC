{{-- resources/views/landing/components/header.blade.php --}}
<header class="container my-3">
    <div class="row align-items-stretch  ">
        <!-- Logo en contenedor granate -->
        <div class="col-md-2 shadow  d-flex align-items-center justify-content-center rounded-bottom-4 d-none d-lg-flex " style="background-color: #8D0C28;"
           >
            <img src="{{ image('logos/logo-cusco.svg') }}" alt="Logo" class="p-3" >
        </div>


        <!-- Contenedor de textos y menú -->
        <div class="col-md-10 ">
            <!-- Contenedor gris para textos -->
            <div class="bg-secondary bg-opacity-25 rounded-bottom-4 p-3 d-flex flex-column justify-content-between " style="background-image:url({{ asset('assets/media/bg/bg-transparencia.webp') }}); background-size: cover; background-position: center; ">
                <!-- Textos del Header -->
                <div class="text-center">
                    <h1 class="fw-bold  m-0" style="color: #8D0C28;">TRANSPARENCIA INSTITUCIONAL</h1>
                    <p class="fw-bold text-muted m-0">Municipalidad Provincial de Cusco</p>
                </div>
            </div>

            <!-- Menú Horizontal -->
            <nav class="mt-3">
                <ul class="nav justify-content-center ">
                    <li class="nav-item mx-1">
                        <a class=" btn btn-outline-secondary  rounded px-3 " href="#">Normas Emitidas</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="btn btn-outline-secondary rounded px-3" href="#">Normas Institucionales</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="btn btn-outline-secondary rounded px-3" href="#">Transparencia</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Línea Horizontal Granate -->
    <hr class="my-1 bg-secondary ">
</header>
