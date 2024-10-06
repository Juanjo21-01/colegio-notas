<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Instituto {{ $metaTitle ?? '' }}</title>

    <!-- Fonts -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block p-0">
                                <img src="/img/fondo-login.png" alt="Fondo de la página" class="img-fluid" />
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-center pt-2">
                                    <img src="/img/logo.png" alt="Fondo de la página" class="img-fluid" />
                                </div>
                                <div class="px-5 pb-2">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
