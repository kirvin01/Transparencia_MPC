{{-- resources/views/landing/landing.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Transparencia</title>
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
</head>
<body>

    {{-- Header --}}
    @include('landing.components.header')

    {{-- Formulario de Búsqueda --}}
    <section class="container my-4">
        @include('landing.partials.search_form')
    </section>

    {{-- Contenedor de Cards --}}
    <section class="container my-4">
        <div class="row">
            @for ($i = 0; $i < 10; $i++)  {{-- Ejemplo para 4 cards --}}
                @include('landing.partials.card')
            @endfor
        </div>
    </section>

    {{-- Footer --}}
    @include('landing.components.footer')

    {{-- Scripts de Bootstrap y Vue.js --}}
    <script src="{{ asset('assets/js/landing.js') }}"></script>
</body>
</html>
