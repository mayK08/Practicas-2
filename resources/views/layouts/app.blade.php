<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Declaranet Sonora | @yield('title', 'Empleados')</title>
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
    <!-- ================== END BASE CSS STYLE ================== -->

    @stack('styles')
</head>
<body class="">
    <!-- BEGIN #app -->
    <div id="app" class="app app-content-full-height app-footer-fixed">
        <!-- BEGIN #sidebar -->
        <div id="sidebar" class="app-sidebar">
            <div class="auth-bg auth-bg-scroll" style="background-image: url({{ asset('images/login-bg.jpg') }});">
                <div class="auth-mask"></div>
            </div>

            <!-- BEGIN scrollbar -->
            <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
                <!-- BEGIN mobile-toggler -->
                <div class="mobile-toggler">
                    <button type="button" class="menu-toggler" data-dismiss="sidebar-mobile">
                        <span class="mdi mdi-arrow-left"> </span>
                    </button>
                </div>
                <!-- END mobile-toggler -->

                <div class="desktop-toggler">
                    <button type="button" class="menu-toggler" data-toggle="sidebar-minify">
                        <span class="mdi mdi-arrow-left"> </span>
                    </button>
                </div>

                <!-- BEGIN brand -->
                <div class="brand">
                <a class="brand-logo" href="{{ url('/') }}" title="Gobierno del Estado de Sonora">
          <img src="{{ asset('images/escudo-sonora-blanco.svg') }}" class="logo" alt="Gobierno del Estado de Sonora" style="height: 70px; margin: 10px auto;">
        </a>
                </div>
                <!-- END brand -->

                <!-- BEGIN menu -->
                <div class="menu">
                    <div class="menu-header"><span class="menu-text">Navegación</span></div>
                    <div class="menu-item">
                        <a href="/" class="menu-link">
                            <span class="menu-icon"><i class="mdi mdi-view-dashboard-variant-outline"></i></span>
                            <span class="menu-text">Inicio</span>
                        </a>
                    </div>
                    <div class="menu-divider"></div>
                    <div class="menu-header"><span class="menu-text">Administración</span></div>
                    <div class="menu-item">
                        <a href="{{ route('usuarios') }}" class="menu-link">
                            <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
                            <span class="menu-text">Empleados</span>
                        </a>
                    </div>
                    <div class="menu-divider"></div>
                    <div class="menu-header"><span class="menu-text">Cerrar Sesión</span></div>
                    <div class="menu-item">
                        <a href="#" class="menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="menu-icon"><i class="mdi mdi-logout-variant"></i></span>
                            <span class="menu-text">Salir del Sistema</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <!-- END menu -->
            </div>
            <!-- END scrollbar -->

            <!-- BEGIN mobile-sidebar-backdrop -->
            <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
            <!-- END mobile-sidebar-backdrop -->
        </div>
        <!-- END #sidebar -->

        <div id="content" class="app-content">
            <div class="container-fluid">
                <!-- BEGIN #header -->
                <div id="header" class="app-header">
                    <!-- BEGIN mobile-toggler -->
                    <div class="mobile-toggler">
                        <button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                    <!-- END mobile-toggler -->

                    <!-- BEGIN menu -->
                    <div class="menu">
                        <h3 class="page-header">
                            @yield('header', 'Empleados')
                        </h3>

                        <div class="menu-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" title="Usuario Verificado" data-bs-display="static" class="menu-link">
                                <div class="menu-img">
                                    <i class="mdi mdi-account-circle-outline"></i>
                                </div>
                                <div class="menu-text lh-1">
                                    {{ Auth::user()->name ?? 'Usuario' }} <span class="mdi mdi-chevron-down"></span>
                                    <small class="d-block fw-normal">{{ Auth::user()->email ?? 'usuario@ejemplo.com' }}</small>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end me-lg-3 py-0 border">
                                <div class="dropdown-divider my-0"></div>
                                <a class="dropdown-item d-flex align-items-center" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="mdi mdi-exit-to-app fs-4 me-2 text-pink"></span> Salir
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END menu -->
                </div>
                <!-- END #header -->

                <section class="py-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </section>

                @yield('content')
            </div>
        </div>
    </div>
    <!-- END #app -->

    <!-- BEGIN btn-scroll-top -->
    <a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
    <!-- END btn-scroll-top -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/plugins/telerik-ui/js/kendo.all.min.js') }}"></script>
    <!-- ================== END BASE JS ================== -->
    
    <!-- Script para prevenir navegación en historial después de cerrar sesión -->
    <script>
        // Función para detectar si la sesión ha expirado o se ha cerrado
        function verificarSesion() {
            // Hacer una petición AJAX para verificar el estado de la sesión
            fetch('{{ route('verificar.sesion') }}', {
                method: 'GET',
                cache: 'no-store',
                credentials: 'same-origin',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (!data.autenticado) {
                    // Sesión cerrada - redirigir a login
                    window.location.href = '{{ route('login') }}';
                }
            })
            .catch(error => {
                console.error('Error verificando sesión:', error);
            });
        }
        
        // Verificar sesión cuando la página se carga
        document.addEventListener('DOMContentLoaded', function() {
            // Deshabilitar caché del navegador para esta página
            window.onpageshow = function(event) {
                if (event.persisted) {
                    // La página fue restaurada desde caché (botón atrás)
                    verificarSesion();
                }
            };
            
            // Prevenir uso del botón atrás después del logout
            window.history.pushState(null, '', window.location.href);
            window.addEventListener('popstate', function() {
                window.history.pushState(null, '', window.location.href);
                verificarSesion();
            });
        });
    </script>

    @stack('scripts')
</body>
</html> 