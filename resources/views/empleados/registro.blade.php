<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Registro de Empleado</title>
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

    <link href="{{ asset('css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <!-- ================== END BASE CSS STYLE ================== -->
</head>

<body class="">
    <div class="app app-public">
        <header>
            <section id="top-header">
                <div class="container">
                    <div class="container-inner">
                        <div class="row">
                            <div class="col-6 col-sm-2">
                                <div class="logo">
                                    <a href="https://www.sonora.gob.mx" target="_blank" rel="nofollow noreferrer noopener">
                                        <img class="sppb-img-responsive" src="{{ asset('images/logo-escudo.svg') }}" alt="Gobierno del Estado de Sonora" title="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 col-sm-10">
                                <nav class="navbar navbar-expand-lg" aria-label="Menú de Accesos de Gobierno">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbar-120" aria-controls="navbar-120" aria-labels="Alternar navegación">
                                        <span class="mdi mdi-menu" aria-hidden="true"></span>
                                    </button>
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="navbar-120" aria-labelledby="navbar-120Label">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="navbar-120Label">Accesos de Gobierno</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <ul class="menu navbar-nav justify-content-end flex-grow-1 pe-3 menu-accesos nav">
                                                <li class="item-274">
                                                    <a href="https://www.sonora.gob.mx/servicios-y-tramites" class="nav-link" target="_blank" rel="noopener noreferrer">Servicios y Trámites</a>
                                                </li>
                                                <li class="item-275">
                                                    <a href="https://www.sonora.gob.mx/gobierno" class="nav-link" target="_blank" rel="noopener noreferrer">Gobierno</a>
                                                </li>
                                                <li class="item-276">
                                                    <a href="https://datos.sonora.gob.mx" class="nav-link" target="_blank" rel="noopener noreferrer">Datos Abiertos</a>
                                                </li>
                                                <li class="item-288">
                                                    <a href="https://www.visitsonora.mx" class="nav-link" target="_blank" rel="noopener noreferrer">Visitantes</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="container">
                <nav class="" aria-label="Breadcrumbs">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="pathway" title="Ir al inicio">
                                <span class="divider mdi mdi-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item active"><span>Registro de Empleado</span></li>
                    </ol>
                </nav>
            </div>
        </header>

        <div id="content" class="app-public-content">
            <div class="w-100 w-sm-75 mx-auto my-5">
                <h2 class="text-tertiary text-uppercase fw-700 text-center mb-3">
                    Registro de Empleado
                </h2>
                <p class="text-center fs-5 mb-0">
                    Por favor complete todos los campos requeridos para registrar su solicitud.
                </p>
            </div>

            <div class="w-90 w-sm-50 mx-auto">
                <form id="registerForm" novalidate autocomplete="off" class="form-group">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="text-dark fw-700 mb-3 fs-5">Datos Generales</h3>
                        </div>
                        <div class="col-sm-4 text-end">
                            <span class="text-danger">Campos obligatorios *</span>
                        </div>
                    </div>

                    <div class="card card-body p-5">
                        <div class="row g-4">
                            <div class="col-sm-12">
                                <div class="form-floating outline">
                                    <input type="text"
                                        class="form-control form-control-lg"
                                        id="curp"
                                        name="curp"
                                        required
                                        pattern="[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[A-Z0-9][0-9]"
                                        style="text-transform: uppercase;"
                                        placeholder="Clave Única de Registro de Población">
                                    <label for="curp">Clave Única de Registro de Población (CURP) <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating outline">
                                    <input type="text"
                                        class="form-control form-control-lg"
                                        id="apellido_paterno"
                                        name="apellido_paterno"
                                        required
                                        placeholder="Primer apellido">
                                    <label for="apellido_paterno">Primer apellido <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating outline">
                                    <input type="text"
                                        class="form-control form-control-lg"
                                        id="apellido_materno"
                                        name="apellido_materno"
                                        required
                                        placeholder="Segundo apellido">
                                    <label for="apellido_materno">Segundo apellido <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating outline">
                                    <input type="text"
                                        class="form-control form-control-lg"
                                        id="nombre"
                                        name="nombre"
                                        required
                                        placeholder="Nombre(s)">
                                    <label for="nombre">Nombre(s) <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-8">
                            <h3 class="text-dark fw-700 mb-3 fs-5">Datos Laborales</h3>
                        </div>
                        <div class="col-sm-4 text-end">
                            <span class="text-danger">Campos obligatorios *</span>
                        </div>
                    </div>

                    <div class="card card-body p-5">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="form-floating outline">
                                    <input type="text"
                                        class="form-control form-control-lg"
                                        id="num_empleado"
                                        name="num_empleado"
                                        required
                                        placeholder="Número de Empleado">
                                    <label for="num_empleado">Número de Empleado <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-floating outline">
                                    <input type="text"
                                        class="form-control form-control-lg"
                                        id="puesto"
                                        name="puesto"
                                        required
                                        placeholder="Puesto">
                                    <label for="puesto">Puesto <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-floating outline">
                                    <input type="text"
                                        class="form-control form-control-lg"
                                        id="dependencia"
                                        name="dependencia"
                                        required
                                        placeholder="Dependencia">
                                    <label for="dependencia">Dependencia <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-8">
                            <h3 class="text-dark fw-700 mb-3 fs-5">Datos de Contacto</h3>
                        </div>
                        <div class="col-sm-4 text-end">
                            <span class="text-danger">Campos obligatorios *</span>
                        </div>
                    </div>

                    <div class="card card-body p-5">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="form-floating outline">
                                    <input type="email"
                                        class="form-control form-control-lg"
                                        id="email"
                                        name="email"
                                        required
                                        placeholder="Correo electrónico">
                                    <label for="email">Correo electrónico <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-floating outline">
                                    <input type="tel"
                                        class="form-control form-control-lg"
                                        id="telefono"
                                        name="telefono"
                                        required
                                        placeholder="Teléfono">
                                    <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-end">
                        <a href="{{ url('/') }}" class="btn btn-secondary">
                            <span>Regresar</span>
                        </a>
                        <button type="submit" class="btn btn-success">
                            <span>Enviar Solicitud</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="logo mb-3">
                            <img src="{{ asset('images/logo-sonora-white.svg') }}" alt="Gobierno del Estado de Sonora" title="">
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-3">
                        <div class="mt-3 mb-3">
                            <ul class="social-networks d-flex justify-content-center">
                                <a href="https://www.facebook.com/gobiernosonora" aria-label="Facebook" target="_blank" rel="nofollow noreferrer noopener">
                                    <i class="fab fa-facebook" aria-hidden="true" title="Facebook"></i>
                                </a>
                                <a href="https://www.twitter.com/gobiernosonora" aria-label="Twitter" target="_blank" rel="nofollow noreferrer noopener">
                                    <i class="fab fa-twitter" aria-hidden="true" title="Twitter"></i>
                                </a>
                                <a href="https://www.instagram.com/gobiernodesonora" aria-label="Instagram" target="_blank" rel="nofollow noreferrer noopener">
                                    <i class="fab fa-instagram" aria-hidden="true" title="Instagram"></i>
                                </a>
                            </ul>
                        </div>
                        <div class="text-center mb-3">
                            @GobiernoSonora
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="emergency">
                            <a href="tel://911" target="_blank">
                                <img src="{{ asset('images/911.svg') }}" alt="911 Número de Emergencias" title="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ================== END BASE JS ================== -->

    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();

                // Validar CURP
                const curp = $('#curp').val();
                if (!validateCURP(curp)) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Por favor ingrese un CURP válido',
                        icon: 'error'
                    });
                    return;
                }

                // Enviar solicitud
                $.ajax({
                    url: '/api/empleados/solicitud',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success && response.redirect) {
                            window.location.href = response.redirect;
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Error al procesar la solicitud',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Error al enviar la solicitud';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                        }
                        Swal.fire({
                            title: 'Error',
                            text: errorMessage,
                            icon: 'error'
                        });
                    }
                });
            });

            // Función para validar CURP
            function validateCURP(curp) {
                const regex = /^[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[A-Z0-9][0-9]$/;
                return regex.test(curp);
            }
        });
    </script>
</body>

</html>