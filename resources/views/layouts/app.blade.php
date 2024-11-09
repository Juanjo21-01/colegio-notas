<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Instituto @yield('title', ' ')</title>

    <!-- Icon -->
    <link rel="icon" href="{{ asset('img/logotipo.png') }}" type="image/png">

    <!-- Fonts -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="inicio">
    <div id="wrapper">
        <!-- Sidebar -->
        @include('layouts.navigation')

        <!-- Contenido de la pagina -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                @include('layouts.topbar')

                <!-- Contenido -->
                <main class="container-fluid">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <!-- Scroll -->
    <a class="scroll-to-top rounded" href="#inicio">
        <i class="bi bi-caret-up-fill"></i>
    </a>
</body>

</html>
