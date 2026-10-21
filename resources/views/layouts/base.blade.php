<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('src/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('src/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('src/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('src/owncss/app.css') }}">
    @stack('styles')
</head>
<body class="@yield('body-class')">
    @yield('body')

    <script src="{{ asset('src/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('src/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('src/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('src/off-canvas.js') }}"></script>
    <script src="{{ asset('src/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('src/template.js') }}"></script>
    <script src="{{ asset('src/settings.js') }}"></script>
    @stack('scripts')
</body>
</html>
