<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSPARENCIA INSTITUCIONAL</title>
    {{-- Incluye aquí CSS de Bootstrap y estilos adicionales --}}
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
</head>

<body>
    {{-- Incluir Header --}}
    @include('landing.components.header')

    {{-- Contenido principal de la página --}}
    <main>
        @yield('content')
    </main>

    {{-- Incluir Footer --}}
    @include('landing.components.footer')

    {{-- Incluye aquí JavaScript, Bootstrap y Vue.js --}}
    <script src="{{ asset('assets/js/landing.js') }}"></script>
    
</body>

</html>
