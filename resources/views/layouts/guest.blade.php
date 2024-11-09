<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Instituto Raquel Adolfo Barrios {{ $metaTitle ?? '' }}</title>

    <!-- Icon -->
    <link rel="icon" href="{{ asset('img/logotipo.png') }}" type="image/png">

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
                            <div class="col-lg-7 d-none d-lg-block">
                                <img src="/img/fondo-login.png" alt="Fondo de la página" class="img-fluid" />
                            </div>
                            <div class="col-lg-5">
                                <div class="d-flex justify-content-center pt-2">
                                    <img src="/img/logotipo.png" alt="Fondo de la página" class="img-fluid"
                                        Width="100" />
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
