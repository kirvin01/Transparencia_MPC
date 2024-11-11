<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Landing Page')</title>
    <!-- Agrega los enlaces de CSS y scripts específicos para la landing page -->
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    
</head>
<body>
    <header>
        <!-- Encabezado específico para la landing page -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Pie de página específico para la landing page -->
    </footer>

    <!-- Scripts de JavaScript específicos para la landing page -->
    <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>
