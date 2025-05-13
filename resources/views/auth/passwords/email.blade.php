<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Recuperar Contraseña | Declaranet Sonora</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" type="image/vnd.microsoft.icon" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <!-- ================== END BASE CSS STYLE ================== -->
</head>

<body class="auth">
    <div id="app" class="app auth-wrapp">
        <div class="auth-pattern"></div>
        <div class="auth-bg auth-bg-scroll" style="background-image: url({{ asset('images/login-bg.jpg') }});">
            <div class="auth-mask"></div>
        </div>
        <div class="auth-content">
            <div class="container-fluid">
                <div class="row g-0">
                    <div class="col-md-5 offset-md-7">
                        <div class="auth-form">
                            <h3 class="text-uppercase text-white"><span class="mdi mdi-lock-reset"></span> Recuperar Contraseña</h3>
                            
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="my-3">
                                    <div class="form-floating outline outline-white">
                                        <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" 
                                            id="username" name="username" value="{{ old('username') }}" 
                                            required placeholder="Ingresa tu nombre de usuario">
                                        <label for="username">Nombre de Usuario</label>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-5 text-center">
                                    <button type="submit" class="btn btn-white btn-lg shadow-sm rounded-pill">
                                        Enviar enlace de recuperación
                                    </button>
                                </div>
                            </form>

                            <p class="text-center text-white mt-5 mb-5 mb-sm-0">
                                <a class="link-warning" href="{{ route('login') }}">
                                    <span class="mdi mdi-arrow-left"></span> Volver al inicio de sesión
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <!-- ================== END BASE JS ================== -->
</body>
</html> 