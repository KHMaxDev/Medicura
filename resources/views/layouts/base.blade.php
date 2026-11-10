<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#e9f2f4">
    <meta name="description" content="Medicura: un espacio para conectar el cuidado. Demo interactiva de gestión médica.">
    <title>@yield('title', 'Medicura · El cuidado, conectado')</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#main">Saltar al contenido</a>
    @yield('body')
    <div id="toast" class="toast" role="status" aria-live="polite" hidden></div>
    <noscript><p class="noscript">Activa JavaScript para explorar esta demo interactiva.</p></noscript>
</body>
</html>
