<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Recuperar Contraseña - Declaranet Sonora</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" type="image/vnd.microsoft.icon" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">

    <link href="{{ asset('css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/telerik-ui/css/bootstrap-4.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/telerik-ui/css/sonora-ui-2023.css') }}" rel="stylesheet">
    <link href="https://kendo.cdn.telerik.com/2023.3.1114/styles/kendo.bootstrap-v4.min.css" rel="stylesheet">
    <link href="https://kendo.cdn.telerik.com/2023.3.1114/styles/kendo.default-v2.min.css" rel="stylesheet">
    <!-- ================== END BASE CSS STYLE ================== -->
</head>

<body class=" auth">
    <div id="app" class="app auth-wrapp">
        <div class="auth-pattern"></div>
        <div class="auth-bg auth-bg-scroll" style="background-image: url(/images/login-bg.jpg);">
            <div class="auth-mask"></div>
        </div>
        <div class="auth-content">
            <div class="container-fluid">
                <div class="row g-0">
                    <div class="col-sm-7 auth-border">
                        <div class="auth-info">
                            <header class="mb-5">
                                <div class="row justify-content-center align-items-center m-0 mb-sm-5 mb-md-3">
                                    <div class="col-sm-3 d-none d-sm-inline-block">
                                        <a class="auth-logo logo-1" href="https://www.sonora.gob.mx" title="">
                                            <img src="{{ asset('images/logo-sonora-white.svg') }}" class="" alt="Gobierno del Estado de Sonora">
                                        </a>
                                    </div>
                                    <div class="col-6 col-sm-3 offset-0 offset-sm-1 ">
                                        <a class="auth-logo logo-3" href="https://om.sonora.gob.mx" title="">
                                            <img src="{{ asset('images/logo-gobierno-digital-white.svg') }}" class="" alt="Subsecretaría de Gobierno Digital">
                                        </a>
                                    </div>
                                </div>
                            </header>
                            <div class="row my-auto justify-content-center mb-0 mb-sm-5 mb-md-3 ">
                                <div class="col-12 col-sm-8 col-md-10 text-center">
                                    <h2 class="mb-3">Recuperación de Contraseña</h2>
                                    <p class="">
                                        Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                                    </p>
                                </div>
                            </div>
                            <footer>
                                <div class="auth-footer d-none d-sm-block">
                                    <div class="row justify-content-center">
                                        <div class="col-sm-8 col-md-10 text-center">
                                            <p class=" text-light-400 mb-0">
                                                Centro de Gobierno, Edificio Hermosillo 2do. piso. Blvd. Paseo Río Sonora y Comonfort. Col. Villa de Seris. C.P. 83280, Hermosillo, Sonora, México.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="auth-form">
                            <h3 class="text-uppercase text-white"><span class="mdi mdi-lock-reset"></span> Recuperar Contraseña</h3>
                            
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}" id="resetForm">
                                @csrf
                                <div class="my-3">
                                    <div class="form-floating outline outline-white">
                                        <input type="email"
                                            class="form-control form-control-lg fs-15px @error('email') is-invalid @enderror"
                                            placeholder="Ingresa tu correo electrónico" name="email" value="{{ old('email') }}" required
                                            autofocus />
                                        <label for="email">Correo electrónico</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-5 text-center">
                                    <button type="submit" class="btn btn-white btn-lg shadow-sm rounded-pill">
                                        Enviar Enlace de Recuperación
                                    </button>
                                </div>
                            </form>

                            <div class="mt-4 text-center">
                                <a href="{{ route('login') }}" class="link-light">
                                    <span class="mdi mdi-arrow-left"></span> Volver al Inicio de Sesión
                                </a>
                            </div>

                            <div class="d-sm-none w-50 m-auto d-block text-center mt-5">
                                <a class="" href="https://www.sonora.gob.mx" title="">
                                    <img src="{{ asset('images/logo-sonora-white.svg') }}" class="" alt="Gobierno del Estado de Sonora">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2023.3.1114/js/kendo.all.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2023.3.1114/js/kendo.aspnetmvc.min.js"></script>
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#resetForm').on('submit', function(e) {
                const email = $('input[name="email"]').val();
                if (!email) {
                    e.preventDefault();
                    alert('Por favor ingresa tu correo electrónico');
                    return false;
                }
            });
        });
    </script>
</body>
</html>
