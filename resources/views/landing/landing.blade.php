{{-- resources/views/landing/landing.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Transparencia</title>
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    {{-- Header --}}
    @include('landing.components.header')
    <div id="app">
        {{-- Formulario de Búsqueda --}}
        <section class="container my-4">
            @include('landing.partials.search_form')
        </section>

        {{-- Contenedor de Cards --}}
        {{-- Contenedor de Cards --}}
        <section class="container my-4">
            <div class="row">
                @include('landing.partials.card')
            </div>
        </section>
    </div>
    {{-- Footer --}}
    @include('landing.components.footer')

    {{-- Scripts de Bootstrap y Vue.js --}}
    <script src="{{ mix('assets/js/landing.js') }}"></script>
</body>

</html>
