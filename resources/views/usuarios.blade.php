<!DOCTYPE html>
<html lang="es">
<head>
  @php
  use Illuminate\Support\Facades\Auth;
  @endphp
  <meta charset="utf-8" />
  <title>Usuarios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Sistema de gestión de empleados" />
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

  <!-- Toastr CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

  <link href="{{ asset('css/vendor.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
  <link href="{{ asset('js/plugins/telerik-ui/css/bootstrap-4.css') }}" rel="stylesheet">
  <link href="{{ asset('js/plugins/telerik-ui/css/sonora-ui-2023.css') }}" rel="stylesheet">
  <!-- ================== END BASE CSS STYLE ================== -->
  <style>
    .card {
      transition: all 0.3s;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .card-resumen {
      height: 100%;
      border-left: 4px solid #007bff;
    }
    .card-activos {
      border-left-color: #28a745;
    }
    .card-inactivos {
      border-left-color: #dc3545;
    }
    .card-total {
      border-left-color: #17a2b8;
    }
    .menu-item.active .menu-link {
      color: #fff;
      background-color: rgba(255, 255, 255, 0.15);
      font-weight: 600;
    }
    .btn-filter {
      transition: all 0.3s;
    }
    .btn-filter:hover {
      transform: translateY(-2px);
    }
    .k-grid {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .k-grid th {
      background-color: #f8f9fa;
      font-weight: 600;
    }
    .k-grid tr:hover {
      background-color: #f5f9ff !important;
    }
    .status-badge {
      padding: 6px 12px;
      border-radius: 50px;
      font-size: 12px;
      font-weight: 600;
    }
    .status-activo {
      background-color: #e8f5e9;
      color: #28a745;
    }
    .status-inactivo {
      background-color: #ffebee;
      color: #dc3545;
    }
    .app-filters {
      border-radius: 8px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    /* Estilos para las tarjetas de resumen */
    .card-resumen {
      transition: all 0.3s ease;
      border-radius: 0.5rem;
      border: none;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    /* Los estilos para auth-bg-scroll se aplican vía JavaScript */
    
    /* Estilos para las tarjetas según su tipo */
    .card-total {
      border-left: 4px solid #0dcaf0;
    }
    
    /* Estilo para filas seleccionadas */
    .row-selected {
      background-color: #e8f4fe !important;
      box-shadow: inset 3px 0 0 #007bff;
      font-weight: 500;
    }
    
    /* Hacer que las filas de la tabla sean clicables */
    #empleadosTable tbody tr {
      cursor: pointer;
      transition: all 0.2s;
    }
    
    #empleadosTable tbody tr:hover {
      background-color: #f0f7ff !important;
    }
  </style>
</head>
<body class="">
<!-- BEGIN #app -->
<div id="app" class="app app-content-full-height app-footer-fixed ">


  <!-- BEGIN #sidebar -->
  <div id="sidebar" class="app-sidebar">

    <div class="auth-bg auth-bg-scroll">
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
        <div class="menu-header"><span class="menu-text">Gestión</span></div>

        <div class="menu-item active">
          <a href="{{ route('usuarios') }}" class="menu-link">
            <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
            <span class="menu-text">Empleados</span>
          </a>
        </div>

        <div class="menu-item">
          <a href="{{ route('usuarios.gestion-roles') }}" class="menu-link">
            <span class="menu-icon"><i class="mdi mdi-account-cog"></i></span>
            <span class="menu-text">Gestión de Roles</span>
          </a>
        </div>

        <div class="menu-item">
          <a href="{{ route('solicitudes.index') }}" class="menu-link">
            <span class="menu-icon"><i class="mdi mdi-book-clock-outline"></i></span>
            <span class="menu-text">Solicitudes</span>
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
            <i class="mdi mdi-account-group me-2 text-primary"></i>Gestión de Empleados
          </h3>

          <div class="menu-item dropdown">
            <a href="#" data-bs-toggle="dropdown" title="Usuario Verificado" data-bs-display="static" class="menu-link">
              <div class="menu-img">
                <i class="mdi mdi-account-circle-outline"></i>
              </div>

              <div class="menu-text lh-1">
                @if(Auth::check())
                  {{ Auth::user()->username ?? 'Usuario' }}
                @else
                  Usuario
                @endif
                <span class="mdi mdi-chevron-down"></span>
                <small class="d-block fw-normal">
                  @if(Auth::check())
                    {{ Auth::user()->rol ?? Auth::user()->role ?? 'Usuario' }}
                  @else
                    Usuario
                  @endif
                </small>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-lg-3 py-0 border shadow">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('perfil') }}">
                <span class="mdi mdi-account-circle fs-4 me-2 text-primary"></span> Mi perfil
              </a>
              <div class="dropdown-divider my-0"></div>

              <a class="dropdown-item d-flex align-items-center" href="{{ url('perfil') }}">
                <i class="mdi mdi-face-agent fs-4 me-2 text-primary"></i> Soporte
              </a>
              <div class="dropdown-divider my-0"></div>

              <a class="dropdown-item d-flex align-items-center" href="{{ url('salir') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="mdi mdi-exit-to-app fs-4 me-2 text-primary"></span> Salir
              </a>

              <form id="logout-form" action="{{ url('salir') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </div>
        </div>
        <!-- END menu -->
      </div>
      <!-- END #header -->
      
      <!-- Breadcrumb y título -->
      <section class="py-3 d-flex justify-content-between align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Empleados</li>
          </ol>
        </nav>
      </section>
      
      <!-- Resumen en tarjetas -->
      <section class="mb-4">
        <div class="row g-3">
          <div class="col-md-4">
            <div class="card card-resumen card-total h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-account-group text-info" style="font-size: 2rem;"></i>
                </div>
                <div>
                  <h6 class="card-subtitle mb-1 text-muted">Total Empleados</h6>
                  <h3 class="card-title mb-0" id="totalEmpleados">-</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-resumen card-activos h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-account-check text-success" style="font-size: 2rem;"></i>
                </div>
                <div>
                  <h6 class="card-subtitle mb-1 text-muted">Empleados Activos</h6>
                  <h3 class="card-title mb-0" id="empleadosActivos">-</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-resumen card-inactivos h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-account-off text-danger" style="font-size: 2rem;"></i>
                </div>
                <div>
                  <h6 class="card-subtitle mb-1 text-muted">Empleados Inactivos</h6>
                  <h3 class="card-title mb-0" id="empleadosInactivos">-</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Filtros -->
      <section class="bg-light app-filters mb-4">
        <form id="filterForm" action="{{ route('empleados.index') }}" method="GET" autocomplete="off">
          <div class="row g-3">
            <div class="col-12">
              <h5 class="mb-3"><i class="mdi mdi-filter-outline me-2"></i>Filtros de búsqueda</h5>
            </div>
            <div class="col-12 col-sm-3">
              <label for="curp" class="form-label">CURP</label>
              <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-card-account-details-outline"></i></span>
                <input class="form-control" placeholder="CURP" name="curp" type="text" id="curp">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
              <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                <input class="form-control" placeholder="Apellido Paterno" name="apellido_paterno" type="text" id="apellido_paterno">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <label for="apellido_materno" class="form-label">Apellido Materno</label>
              <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                <input class="form-control" placeholder="Apellido Materno" name="apellido_materno" type="text" id="apellido_materno">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <label for="nombre" class="form-label">Nombre</label>
              <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                <input class="form-control" placeholder="Nombre" name="nombre" type="text" id="nombre">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <label for="num_empleado" class="form-label">Número de Empleado</label>
              <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-badge-account-horizontal-outline"></i></span>
                <input class="form-control" placeholder="Número de Empleado" name="num_empleado" type="text" id="num_empleado">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <label for="puesto" class="form-label">Puesto</label>
              <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-briefcase-outline"></i></span>
                <input class="form-control" placeholder="Puesto" name="puesto" type="text" id="puesto">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <label for="dependencia" class="form-label">Dependencia</label>
              <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-office-building-outline"></i></span>
                <input class="form-control" placeholder="Dependencia" name="dependencia" type="text" id="dependencia">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <label for="email" class="form-label">Correo Electrónico</label>
              <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                <input class="form-control" placeholder="Correo Electrónico" name="email" type="text" id="email">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-phone-outline"></i></span>
                <input class="form-control" placeholder="Teléfono" name="telefono" type="text" id="telefono">
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <label for="status" class="form-label">Estado</label>
              <div class="input-group">
                <span class="input-group-text"><i class="mdi mdi-toggle-switch-outline"></i></span>
                <select class="form-select picker" name="status" id="status">
                  <option value="">Seleccione un estado</option>
                  <option value="Activo">Activo</option>
                  <option value="Inactivo">Inactivo</option>
                </select>
              </div>
            </div>
            <div class="col-12 d-flex justify-content-end gap-2 mt-4">
              <button type="button" id="resetFilters" class="btn btn-outline-secondary btn-filter">
                <i class="mdi mdi-refresh me-1"></i> Reestablecer
              </button>
              <button type="submit" class="btn btn-primary btn-filter" id="btnAplicarFiltros">
                <i class="mdi mdi-filter-check me-1"></i> Aplicar Filtros
              </button>
            </div>
          </div>
        </form>
      </section>

      <!-- Botones de acción -->
      <section class="py-3 mb-3">
        <div class="card">
          <div class="card-body p-3">
            <div class="row g-3 align-items-center">
              <div class="col-md-8">
                <div class="btn-group">
                  <a class="btn btn-success" href="{{ route('empleados.create') }}" title="Nuevo Empleado">
                    <i class="mdi mdi-account-plus me-1"></i> Agregar Empleado
                  </a>
                  <button id="btnEditar" class="btn btn-warning" disabled>
                    <i class="mdi mdi-account-edit me-1"></i> Editar
                  </button>
                  <button id="btnEliminar" class="btn btn-danger" disabled>
                    <i class="mdi mdi-account-remove me-1"></i> Eliminar
                  </button>
                </div>
                <div class="btn-group ms-2">
                  <button id="btnActivar" class="btn btn-outline-success" disabled>
                    <i class="mdi mdi-check-circle me-1"></i> Activar
                  </button>
                  <button id="btnDesactivar" class="btn btn-outline-danger" disabled>
                    <i class="mdi mdi-cancel me-1"></i> Desactivar
                  </button>
                </div>

              </div>
              <div class="col-md-4 text-end">
                <div class="btn-group">
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-export me-1"></i> Exportar
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="mdi mdi-microsoft-excel me-2 text-success"></i> Excel
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="mdi mdi-file-pdf-box me-2 text-danger"></i> PDF
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="mdi mdi-printer me-2 text-primary"></i> Imprimir
                      </a>
                    </li>
                  </ul>
          </div>
                <button id="btnTablaDirecta" class="btn btn-info ms-2">
                  <i class="mdi mdi-refresh me-1"></i> Recargar Tabla
                </button>
        </div>
            </div>
            </div>
          </div>
        </section>

      <!-- Grid -->
      <div class="card mb-4">
        <div class="card-body p-0">
          <div id="grid"></div>
      </div>
      </div>
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
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- ================== END BASE JS ================== -->

<script>
  // Función segura para mostrar notificaciones
  function mostrarNotificacion(tipo, mensaje, titulo = '', opciones = {}) {
    if (typeof toastr === 'undefined') {
      console.log('[Notificación]', tipo, mensaje);
      return;
    }
    
    const config = {
      closeButton: true,
      progressBar: true,
      positionClass: "toast-top-right",
      timeOut: 5000,
      extendedTimeOut: 2000,
      ...opciones
    };
    
    toastr.options = config;
    
    switch(tipo) {
      case 'success':
        toastr.success(mensaje, titulo);
        break;
      case 'info':
        toastr.info(mensaje, titulo);
        break;
      case 'warning':
        toastr.warning(mensaje, titulo);
        break;
      case 'error':
        toastr.error(mensaje, titulo);
        break;
      default:
        toastr.info(mensaje, titulo);
    }
  }

  $(document).ready(function() {
    // Configurar el token CSRF para todas las peticiones AJAX
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // Variables para almacenar el empleado seleccionado
    let empleadoSeleccionado = null;
    let totales = {
      total: 0,
      activos: 0,
      inactivos: 0
    };

    // Función para actualizar el estado de los botones
    function actualizarBotones() {
      const haySeleccion = empleadoSeleccionado !== null;
      
      // Activar/desactivar botones principales
      $("#btnEditar").prop("disabled", !haySeleccion);
      $("#btnEliminar").prop("disabled", !haySeleccion);
      
      // Actualizar botones de activar/desactivar según el estado del empleado
      if (haySeleccion) {
        const esActivo = empleadoSeleccionado.status === 'Activo';
        $("#btnActivar").prop("disabled", esActivo); // Desactivar "Activar" si ya está activo
        $("#btnDesactivar").prop("disabled", !esActivo); // Desactivar "Desactivar" si ya está inactivo
        
        // Actualizar las clases visuales de los botones
        if (esActivo) {
          $("#btnActivar").removeClass('btn-outline-success').addClass('btn-outline-secondary');
          $("#btnDesactivar").removeClass('btn-outline-secondary').addClass('btn-outline-danger');
        } else {
          $("#btnActivar").removeClass('btn-outline-secondary').addClass('btn-outline-success');
          $("#btnDesactivar").removeClass('btn-outline-danger').addClass('btn-outline-secondary');
        }
      } else {
        // Si no hay selección, desactivar todos los botones
        $("#btnActivar").prop("disabled", true).removeClass('btn-outline-success').addClass('btn-outline-secondary');
        $("#btnDesactivar").prop("disabled", true).removeClass('btn-outline-danger').addClass('btn-outline-secondary');
      }
    }

    // Manejar clic en el botón editar
    $("#btnEditar").on("click", function() {
      if (empleadoSeleccionado) {
        window.location.href = "{{ url('empleados') }}/" + empleadoSeleccionado.curp + "/edit";
      }
    });

    // Manejar clic en el botón eliminar
    $("#btnEliminar").on("click", function() {
      if (empleadoSeleccionado) {
        Swal.fire({
          title: '¿Estás seguro?',
          text: "¿Deseas eliminar al empleado " + empleadoSeleccionado.nombre + " " + empleadoSeleccionado.apellido_paterno + "?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "{{ route('empleados.destroy', '') }}/" + empleadoSeleccionado.curp,
              type: "DELETE",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) {
                Swal.fire(
                  '¡Eliminado!',
                  'El empleado ha sido eliminado.',
                  'success'
                );
                // Actualizar la tabla
                verificarDatos();
              },
              error: function(xhr) {
                console.error('Error al eliminar:', xhr);
                Swal.fire(
                  'Error',
                  'No se pudo eliminar el empleado. Por favor, intente nuevamente.',
                  'error'
                );
              }
            });
          }
        });
      }
    });

    // Manejar clic en el botón activar
    $("#btnActivar").on("click", function() {
      if (empleadoSeleccionado) {
        cambiarEstado(empleadoSeleccionado.curp, 'Activo');
      }
    });

    // Manejar clic en el botón desactivar
    $("#btnDesactivar").on("click", function() {
      if (empleadoSeleccionado) {
        cambiarEstado(empleadoSeleccionado.curp, 'Inactivo');
      }
    });

    // Función para cambiar el estado del empleado
    function cambiarEstado(curp, nuevoEstado) {
      console.log('Cambiando estado del empleado:', { curp, nuevoEstado });
      
      $.ajax({
        url: "{{ url('empleados') }}/" + curp + "/cambiar-estado",
        type: "POST",
        data: { status: nuevoEstado },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          console.log('Respuesta del servidor:', response);
          Swal.fire(
            '¡Actualizado!',
            'El estado del empleado ha sido actualizado.',
            'success'
          );
          // Actualizar la tabla
          verificarDatos();
        },
        error: function(xhr, status, error) {
          console.error('Error al cambiar estado:', { xhr, status, error });
          Swal.fire(
            'Error',
            'No se pudo actualizar el estado del empleado. Por favor, intente nuevamente.',
            'error'
          );
        }
      });
    }







    // Función para actualizar las tarjetas de resumen
    function actualizarResumen(data) {
      totales.total = data.length;
      totales.activos = data.filter(item => item.status === 'Activo').length;
      totales.inactivos = data.filter(item => item.status === 'Inactivo').length;
      
      // Actualizar los contadores en las tarjetas
      $("#totalEmpleados").text(totales.total);
      $("#empleadosActivos").text(totales.activos);
      $("#empleadosInactivos").text(totales.inactivos);
    }

    // Función para verificar si hay datos disponibles
    function verificarDatos() {
      // Mostrar loader
      $('#grid').html('<div class="d-flex justify-content-center p-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><span class="ms-2">Cargando datos...</span></div>');
      
      console.log('Verificando datos disponibles...');
      
      // Si hay filtros activos, limpiarlos visualmente
      $('#filterForm')[0].reset();
      
      $.ajax({
        url: "{{ route('empleados.index') }}",
        type: "GET",
        dataType: "json",
        cache: false, // Evitar caché
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          'Accept': 'application/json',
          'Cache-Control': 'no-cache, no-store, must-revalidate',
          'Pragma': 'no-cache',
          'Expires': '0'
        },
        beforeSend: function(xhr) {
          console.log('Enviando solicitud a:', this.url);
        },
        success: function(response) {
          console.log('Respuesta del servidor:', response);
          
          // Extraer los datos según la estructura
          let datos = [];
          if (Array.isArray(response)) {
            console.log('La respuesta es un array directo con', response.length, 'elementos');
            datos = response;
          } else if (response && response.data && Array.isArray(response.data)) {
            console.log('La respuesta contiene data[] con', response.data.length, 'elementos');
            datos = response.data;
          } else if (response && typeof response === 'object') {
            console.log('La respuesta es un objeto:', response);
            // Intentar detectar si hay un campo que podría contener los datos
            for (let key in response) {
              if (Array.isArray(response[key]) && response[key].length > 0) {
                console.log('Posibles datos encontrados en propiedad:', key, 'con', response[key].length, 'elementos');
                datos = response[key];
                break;
              }
            }
          }
          
          console.log('Total de datos procesados:', datos.length);
          
          if (datos.length > 0) {
            console.log('Primer registro:', datos[0]);
            // Actualizar contadores
            actualizarResumen(datos);
            mostrarNotificacion('success', '<i class="mdi mdi-check-circle me-2"></i>Datos cargados correctamente');
            // Mostrar datos directamente en tabla HTML
            renderizarTablaHTML(datos);
          } else {
            console.warn('No se encontraron datos');
            $('#grid').html('<div class="alert alert-warning p-5 text-center">' +
              '<i class="mdi mdi-database-alert fs-1 d-block mb-2"></i>' +
              '<h5>No hay datos disponibles</h5>' +
              '<p>No se encontraron registros de empleados en la base de datos.</p>' +
              '<div class="mt-3">' +
              '<button class="btn btn-outline-primary" onclick="verificarDatos()">Reintentar</button>' +
              '</div>' +
              '</div>');
            
            // Actualizar contadores a cero
            $("#totalEmpleados").text("0");
            $("#empleadosActivos").text("0");
            $("#empleadosInactivos").text("0");
            
            mostrarNotificacion('warning', '<i class="mdi mdi-alert-circle me-2"></i>No hay datos disponibles');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error al verificar datos:', { status, error });
          console.error('Detalles:', xhr.responseText);
          
          $('#grid').html('<div class="alert alert-danger p-5 text-center">' +
            '<i class="mdi mdi-alert-circle-outline fs-1 d-block mb-2"></i>' +
            '<h5>Error al cargar datos</h5>' +
            '<p>No se pudieron recuperar los datos del servidor.</p>' +
            '<div class="mt-3">' +
            '<button class="btn btn-outline-danger mt-2" onclick="verificarDatos()">Reintentar</button>' +
            '</div>' +
            '</div>');
          
          mostrarNotificacion('error', '<i class="mdi mdi-alert-circle me-2"></i>Error al cargar los datos');
        }
      });
    }

    // Función para renderizar la tabla directamente en HTML
    function renderizarTablaHTML(datos, mensajeFiltro = null) {
      // Validaciones iniciales
      if (!datos) {
        console.error('No se recibieron datos para renderizar');
        $('#grid').html('<div class="alert alert-warning p-5 text-center"><i class="mdi mdi-alert-circle fs-1"></i><h5>No hay datos para mostrar</h5></div>');
        return;
      }

      // Verificar si es un array vacío
      if (datos.length === 0) {
        let mensaje = '<div class="alert alert-warning p-5 text-center">' +
          '<i class="mdi mdi-filter-remove fs-1 d-block mb-2"></i>' +
          '<h5>No se encontraron resultados</h5>';
        
        if (mensajeFiltro) {
          mensaje += '<p>' + mensajeFiltro + '</p>';
        }
        
        mensaje += '<button class="btn btn-outline-secondary mt-3" onclick="$(\'#resetFilters\').click();">' +
          '<i class="mdi mdi-refresh me-1"></i>Limpiar filtros</button>' +
          '</div>';
        
        $('#grid').html(mensaje);
        return;
      }
      
      console.log('Renderizando tabla HTML con', datos.length, 'registros');
      
      try {
        // Crear una tabla HTML con estilos de Bootstrap
        let html = '<div class="table-responsive">';
        html += '<table id="empleadosTable" class="table table-striped table-bordered table-hover">';
        
        // Encabezados
        html += '<thead class="table-light"><tr>';
        
        // Usar las keys del primer objeto para los encabezados
        const firstItem = datos[0];
        const camposExcluidos = ['datos_biometricos', 'remember_token', 'created_at', 'updated_at', 'motivo_rechazo'];
        const camposMostrar = [];
        
        // Determinar qué campos mostrar
        for (let key in firstItem) {
          if (!camposExcluidos.includes(key)) {
            camposMostrar.push(key);
            let headerText = key.replace(/_/g, ' ').toUpperCase();
            html += '<th>' + headerText + '</th>';
          }
        }
        html += '</tr></thead>';
        
        // Cuerpo de la tabla
        html += '<tbody>';
        for (let i = 0; i < datos.length; i++) {
          html += '<tr data-curp="' + (datos[i].curp || 'no-curp-' + i) + '">';
          
          // Mostrar solo los campos seleccionados, en el mismo orden
          for (let j = 0; j < camposMostrar.length; j++) {
            const key = camposMostrar[j];
            let valor = datos[i][key] !== null && datos[i][key] !== undefined ? datos[i][key] : '';
            
            // Formatear diferentes tipos de campos
            if (key === 'status') {
              const colorClass = valor === 'Activo' ? 'success' : 'danger';
              const icon = valor === 'Activo' ? 'check-circle' : 'cancel';
              html += '<td><span class="badge bg-' + colorClass + '-subtle text-' + colorClass + '"><i class="mdi mdi-' + icon + ' me-1"></i>' + valor + '</span></td>';
            } else if (key === 'solicitud_status') {
              let colorClass = 'primary';
              if (valor === 'Aprobada') colorClass = 'success';
              if (valor === 'Rechazada') colorClass = 'danger';
              if (valor === 'Pendiente') colorClass = 'warning';
              
              html += '<td><span class="badge bg-' + colorClass + '-subtle text-' + colorClass + '">' + valor + '</span></td>';
            } else if (key === 'curp') {
              html += '<td><span class="fw-bold text-primary">' + valor + '</span></td>';
            } else {
              // Asegurar que el valor sea una cadena para evitar errores
              if (typeof valor === 'object' && valor !== null) {
                valor = JSON.stringify(valor);
              }
              html += '<td>' + valor + '</td>';
            }
          }
          html += '</tr>';
        }
        html += '</tbody></table></div>';
        
        // Información sobre los resultados
        let infoHtml = '<div class="alert alert-info mb-3">';
        infoHtml += '<i class="mdi mdi-information-outline me-2"></i>';
        infoHtml += 'Se encontraron ' + datos.length + ' registros. Haga clic en un empleado para seleccionarlo.';
        
        // Si hay un mensaje de filtro, mostrarlo
        if (mensajeFiltro) {
          infoHtml += '<hr class="my-2">';
          infoHtml += '<div class="d-flex justify-content-between align-items-center">';
          infoHtml += '<div><i class="mdi mdi-filter me-2"></i>' + mensajeFiltro + '</div>';
          infoHtml += '<button class="btn btn-sm btn-outline-secondary" onclick="$(\'#resetFilters\').click();">';
          infoHtml += '<i class="mdi mdi-refresh me-1"></i>Limpiar</button>';
          infoHtml += '</div>';
        }
        
        infoHtml += '</div>';
        
        // Reemplazar el grid con la tabla HTML
        $('#grid').html(infoHtml + html);
        
        // Resetear empleado seleccionado
        empleadoSeleccionado = null;
        actualizarBotones();
        
        // Manejar la selección de filas
        $("#empleadosTable tbody tr").on('click', function() {
          // Eliminar la clase seleccionada de todas las filas
          $("#empleadosTable tbody tr").removeClass('row-selected');
          
          // Añadir la clase seleccionada a esta fila
          $(this).addClass('row-selected');
          
          // Obtener el CURP del empleado seleccionado
          const curp = $(this).data('curp');
          
          // Buscar el empleado en los datos
          const empleado = datos.find(e => e.curp === curp);
          
          if (empleado) {
            // Establecer el empleado seleccionado
            empleadoSeleccionado = empleado;
            console.log('Empleado seleccionado:', empleadoSeleccionado);
            
            // Actualizar los botones según el estado del empleado
            actualizarBotones();
            
            // Mostrar mensaje de confirmación
            mostrarNotificacion('info', '<i class="mdi mdi-account-check me-2"></i>Empleado seleccionado: ' + empleado.nombre + ' ' + empleado.apellido_paterno);
          }
        });
        
        console.log('Tabla HTML renderizada correctamente');
      } catch (error) {
        console.error('Error al renderizar la tabla HTML:', error);
        $('#grid').html('<div class="alert alert-danger p-5 text-center">' +
          '<i class="mdi mdi-alert-circle-outline fs-1 d-block mb-2"></i>' +
          '<h5>Error al renderizar la tabla</h5>' +
          '<p>Se produjo un error al intentar mostrar los datos.</p>' +
          '<div class="mt-3">' +
          '<button class="btn btn-outline-danger" onclick="verificarDatos()">Reintentar</button>' +
          '</div>' +
          '<pre class="mt-3 text-start bg-dark text-light p-3 small" style="max-height: 200px; overflow: auto;">' + error.toString() + '</pre>' +
          '</div>');
        
        mostrarNotificacion('error', '<i class="mdi mdi-alert-circle me-2"></i>Error al renderizar la tabla');
      }
    }

    // Función para buscar por CURP
    function buscarPorCurp(curp) {
      if (!curp || curp.trim() === '') {
        mostrarNotificacion('warning', '<i class="mdi mdi-alert-circle me-2"></i>Por favor ingrese una CURP válida');
        return;
      }
      
      // Mostrar notificación
      mostrarNotificacion('info', '<i class="mdi mdi-magnify me-2"></i>Buscando CURP: ' + curp, '', { timeOut: 2000 });
      
      // Crear URL de búsqueda
      const url = "{{ route('empleados.index') }}?curp=" + encodeURIComponent(curp.trim());
      
      console.log('Redirigiendo a:', url);
      
      // Redirigir a la URL con el parámetro CURP
      window.location.href = url;
    }

    // Función para realizar búsqueda con filtros
    function buscarConFiltros(filtros) {
      // Mostrar loader
      $('#grid').html('<div class="d-flex justify-content-center p-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><span class="ms-2">Aplicando filtros...</span></div>');
      
      // Log detallado de los filtros que se envían
      console.log('Filtros que se enviarán:', JSON.stringify(filtros));
      
      // Notificar al usuario
      mostrarNotificacion('info', '<i class="mdi mdi-filter me-2"></i>Aplicando filtros...', '', { timeOut: 2000 });
      
      // Limpiar cualquier token o campo vacío
      let params = {};
      for (let key in filtros) {
        // Solo incluir campos con valor y excluir el token
        if (filtros[key] && key !== '_token') {
          params[key] = filtros[key];
          console.log(`Incluyendo filtro: ${key} = ${filtros[key]}`);
        }
      }
      
      // Mostrar URL completa para verificación
      const queryString = $.param(params);
      console.log('URL completa para filtros:', "{{ route('empleados.index') }}?" + queryString);
      
      // Verificar si tenemos filtros reales
      if (Object.keys(params).length === 0) {
        console.log('No hay filtros reales para aplicar, mostrando todos los registros');
        verificarDatos();
        return;
      }
      
      // Realizamos la petición AJAX
      $.ajax({
        url: "{{ route('empleados.index') }}",
        type: "GET",
        data: params, // Enviamos solo los parámetros relevantes
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          'Accept': 'application/json'
        },
        beforeSend: function(xhr) {
          console.log('Enviando solicitud a:', this.url);
          console.log('Parámetros enviados:', params);
        },
        success: function(response) {
          console.log("Respuesta del servidor:", response);
          
          // Extraer los datos según la estructura
          let datos = [];
          if (Array.isArray(response)) {
            console.log('Respuesta es un array directo con', response.length, 'elementos');
            datos = response;
          } else if (response && response.data && Array.isArray(response.data)) {
            console.log('Respuesta contiene data[] con', response.data.length, 'elementos');
            datos = response.data;
          } else if (response && typeof response === 'object') {
            console.log('Respuesta es un objeto con propiedades:', Object.keys(response));
            // Intentar encontrar un array en alguna propiedad
            for (let key in response) {
              if (Array.isArray(response[key])) {
                console.log(`Encontrado array en propiedad ${key} con ${response[key].length} elementos`);
                datos = response[key];
                break;
              }
            }
          }
          
          console.log('Total de datos procesados:', datos.length);
          if (datos.length > 0) {
            console.log('Primer registro:', datos[0]);
          }
          
          // Crear mensaje con los filtros aplicados
          let mensajeFiltro = 'Filtros aplicados: ';
          let tieneValores = false;
          
          for (let key in params) {
            mensajeFiltro += formatearNombreFiltro(key) + ': <strong>' + params[key] + '</strong>, ';
            tieneValores = true;
          }
          
          // Quitar la última coma
          if (tieneValores) {
            mensajeFiltro = mensajeFiltro.substring(0, mensajeFiltro.length - 2);
          } else {
            mensajeFiltro = 'Mostrando todos los registros';
          }
          
          // Renderizar la tabla con los resultados
          renderizarTablaHTML(datos, mensajeFiltro);
          
          // Actualizar contadores
          actualizarResumen(datos);
          
          // Mostrar notificación según resultados
          if (datos.length === 0) {
            mostrarNotificacion('warning', '<i class="mdi mdi-filter-remove me-2"></i>No se encontraron resultados con los filtros aplicados');
          } else {
            mostrarNotificacion('success', '<i class="mdi mdi-filter-check me-2"></i>Filtros aplicados. Se encontraron ' + datos.length + ' resultados');
          }
        },
        error: function(xhr, status, error) {
          console.error("Error al aplicar filtros:", { status, error });
          console.error("Detalle del error:", xhr.responseText);
          
          $('#grid').html('<div class="alert alert-danger p-5 text-center">' +
            '<i class="mdi mdi-alert-circle-outline fs-1 d-block mb-2"></i>' +
            '<h5>Error al aplicar filtros</h5>' +
            '<p>No se pudieron aplicar los filtros solicitados.</p>' +
            '<div class="mt-3">' +
            '<button class="btn btn-outline-danger" onclick="reintentarFiltros()">Reintentar</button>' +
            '<button class="btn btn-outline-secondary ms-2" onclick="$(\'#resetFilters\').click();">Limpiar filtros</button>' +
            '</div>' +
            '</div>');
          
          mostrarNotificacion('error', '<i class="mdi mdi-alert-circle me-2"></i>Error al aplicar filtros');
        }
      });
    }

    // Función auxiliar para reintentar la última búsqueda con filtros
    let ultimosFiltros = {};
    function reintentarFiltros() {
      if (Object.keys(ultimosFiltros).length > 0) {
        buscarConFiltros(ultimosFiltros);
      } else {
        verificarDatos();
      }
    }

    // Manejar el envío del formulario de filtros
    $("#filterForm").on("submit", function(e) {
      e.preventDefault();
      console.log('Formulario de filtros enviado');
      
      // Recopilar los datos del formulario
      let filterData = {};
      let hasFilters = false;
      
      // Recopilar solo campos con valores
      $(this).find('input, select').each(function() {
        const name = $(this).attr('name');
        const value = $(this).val();
        
        // Solo incluir campos con nombre y valor no vacío, excluyendo el token CSRF
        if (name && name !== '_token' && value && value.trim() !== '') {
          filterData[name] = value.trim();
          hasFilters = true;
          console.log(`Campo del formulario: ${name} = ${value.trim()}`);
        }
      });
      
      console.log('Datos del formulario recopilados:', JSON.stringify(filterData));
      
      // Si no hay filtros reales, mostrar todos los registros
      if (!hasFilters) {
        console.log('No se encontraron filtros válidos, se cargarán todos los registros');
        mostrarNotificacion('info', '<i class="mdi mdi-information-outline me-2"></i>No se aplicaron filtros, mostrando todos los registros');
        verificarDatos();
        return;
      }
      
      // Con filtros válidos, enviar el formulario normalmente
      console.log('Enviando formulario con filtros');
      
      // Eliminar campos vacíos antes de enviar
      $(this).find('input, select').each(function() {
        if ($(this).val() === '' || $(this).val() === null) {
          $(this).prop('disabled', true);
        }
      });
      
      // Enviar el formulario (método GET tradicional)
      this.submit();
    });

    // Manejar el botón de reestablecer
    $("#resetFilters").on("click", function() {
      console.log('Reestableciendo filtros');
      // Limpiar el formulario
      $("#filterForm")[0].reset();
      // Redirigir a la URL base sin parámetros
      window.location.href = "{{ route('empleados.index') }}";
      // Mostrar notificación
      mostrarNotificacion('info', '<i class="mdi mdi-refresh me-2"></i>Filtros reestablecidos');
    });

    // Manejar el botón de recargar tabla
    $("#btnTablaDirecta").on("click", function() {
      verificarDatos();
    });

    // Al cargar la página, verificar si hay parámetros en la URL para aplicar filtros
    function obtenerParametrosURL() {
      const queryString = window.location.search;
      if (!queryString) return null;
      
      const urlParams = new URLSearchParams(queryString);
      const params = {};
      let hasParams = false;
      
      // Comprobar parámetros comunes
      const posiblesParametros = ['curp', 'nombre', 'apellido_paterno', 'apellido_materno', 
                               'num_empleado', 'puesto', 'dependencia', 'email', 'telefono', 'status'];
      
      posiblesParametros.forEach(param => {
        if (urlParams.has(param) && urlParams.get(param).trim() !== '') {
          params[param] = urlParams.get(param).trim();
          hasParams = true;
          
          // También establecemos el valor en el formulario para mantener coherencia visual
          $(`#${param}`).val(params[param]);
        }
      });
      
      return hasParams ? params : null;
    }
    
    // Inicialización de la página
    function inicializarPagina() {
      const parametrosURL = obtenerParametrosURL();
      
      if (parametrosURL) {
        console.log('Detectados parámetros en la URL:', parametrosURL);
        
        // Si hay un parámetro CURP único, usamos la función específica
        if (parametrosURL.curp && Object.keys(parametrosURL).length === 1) {
          console.log('Aplicando filtro por CURP:', parametrosURL.curp);
          
          // Mostrar loader
          $('#grid').html('<div class="d-flex justify-content-center p-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><span class="ms-2">Filtrando por CURP: ' + parametrosURL.curp + '</span></div>');
          
          // Realizamos la búsqueda con AJAX directamente
          $.ajax({
            url: "{{ route('empleados.index') }}",
            type: "GET",
            data: { curp: parametrosURL.curp },
            dataType: "json",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
              'Accept': 'application/json'
            },
            success: function(response) {
              console.log("Respuesta al filtrar por CURP:", response);
              
              // Procesamiento similar a buscarPorCurp
              let datos = [];
              if (Array.isArray(response)) {
                datos = response;
              } else if (response && response.data && Array.isArray(response.data)) {
                datos = response.data;
              } else if (response && typeof response === 'object') {
                for (let key in response) {
                  if (Array.isArray(response[key])) {
                    datos = response[key];
                    break;
                  }
                }
              }
              
              if (datos.length > 0) {
                // Filtrar por la CURP
                const empleadosFiltrados = datos.filter(e => e.curp && e.curp.toUpperCase().includes(parametrosURL.curp.toUpperCase()));
                
                if (empleadosFiltrados.length > 0) {
                  // Actualizar resumen y mostrar resultados
                  actualizarResumen(empleadosFiltrados);
                  renderizarTablaHTML(empleadosFiltrados, 'Filtrado por CURP: <strong>' + parametrosURL.curp + '</strong>');
                  mostrarNotificacion('success', '<i class="mdi mdi-filter-check me-2"></i>Se encontraron ' + empleadosFiltrados.length + ' resultados');
                } else {
                  // No se encontraron coincidencias
                  $('#grid').html('<div class="alert alert-warning p-5 text-center">' +
                    '<i class="mdi mdi-account-search fs-1 d-block mb-2"></i>' +
                    '<h5>No se encontró ningún empleado con esta CURP</h5>' +
                    '<p>La CURP ingresada fue: <strong>' + parametrosURL.curp + '</strong></p>' +
                    '<div class="mt-3">' +
                    '<button class="btn btn-outline-secondary" onclick="$(\'#resetFilters\').click();">' +
                    '<i class="mdi mdi-refresh me-1"></i>Limpiar filtros</button>' +
                    '</div>' +
                    '</div>');
                    
                  mostrarNotificacion('warning', '<i class="mdi mdi-account-search me-2"></i>No se encontró ningún empleado con CURP: ' + parametrosURL.curp);
                }
              } else {
                // No hay datos generales
                verificarDatos();
              }
            },
            error: function(xhr, status, error) {
              console.error("Error al filtrar por CURP:", error);
              verificarDatos(); // En caso de error, cargar todos los datos
            }
          });
          
        } else {
          // Para múltiples parámetros, llamamos a buscarConFiltros
          console.log('Aplicando múltiples filtros desde URL');
          buscarConFiltros(parametrosURL);
        }
        
      } else {
        // Sin parámetros, cargamos todos los datos
        verificarDatos();
      }
    }
    
    // Iniciar la página
    inicializarPagina();

    // Establecer el fondo del sidebar mediante JavaScript
    $(".auth-bg-scroll").css("background-image", "url('{{ asset('images/login-bg.jpg') }}')");
    $(".auth-bg-scroll").css("background-size", "cover");
    $(".auth-bg-scroll").css("background-position", "center");
    $(".auth-bg-scroll").css("background-repeat", "no-repeat");

    // Función para formatear nombres de filtros
    function formatearNombreFiltro(key) {
      const mapaNombres = {
        'curp': 'CURP',
        'apellido_paterno': 'Apellido Paterno',
        'apellido_materno': 'Apellido Materno',
        'nombre': 'Nombre',
        'num_empleado': 'Número de Empleado',
        'puesto': 'Puesto',
        'dependencia': 'Dependencia',
        'email': 'Correo',
        'telefono': 'Teléfono',
        'status': 'Estado'
      };
      
      return mapaNombres[key] || key.replace('_', ' ').toUpperCase();
    }

    // Diagnóstico directo al cargar la página
    console.log("=== DIAGNÓSTICO INICIAL ===");
    console.log("URL empleados.index:", "{{ route('empleados.index') }}");
    
    // Intento directo para cargar todos los empleados
    $.ajax({
      url: "{{ route('empleados.index') }}",
      type: "GET",
      dataType: "json",
      headers: {
        'Accept': 'application/json'
      },
      success: function(response) {
        console.log("DIAGNÓSTICO - Respuesta directa:", response);
        console.log("DIAGNÓSTICO - Tipo de respuesta:", typeof response);
        
        if (Array.isArray(response)) {
          console.log("DIAGNÓSTICO - Se recibió un array de", response.length, "elementos");
        } else if (response && typeof response === 'object') {
          console.log("DIAGNÓSTICO - Se recibió un objeto con propiedades:", Object.keys(response));
          if (response.data && Array.isArray(response.data)) {
            console.log("DIAGNÓSTICO - El objeto contiene un array 'data' con", response.data.length, "elementos");
          }
        }
      },
      error: function(xhr, status, error) {
        console.error("DIAGNÓSTICO - Error en prueba directa:", error);
      }
    });
    
    // Manejador adicional para el botón de aplicar filtros
    $("#btnAplicarFiltros").off('click').on("click", function(e) {
      // Evitar doble manejo del evento (ya que el submit del formulario se activará)
      if (e.originalEvent) {
        console.log("Botón aplicar filtros clickeado");
        
        // Crear URL para prueba directa
        let filterParams = {};
        let hasParams = false;
        
        $("#filterForm").find('input, select').each(function() {
          const name = $(this).attr('name');
          const value = $(this).val();
          
          if (name && name !== '_token' && value && value.trim() !== '') {
            filterParams[name] = value.trim();
            hasParams = true;
          }
        });
        
        if (hasParams) {
          const queryString = $.param(filterParams);
          const testUrl = "{{ route('empleados.index') }}?" + queryString;
          
          console.log("URL construida para prueba directa:", testUrl);
          console.log("Prueba este enlace directamente en el navegador para verificar la respuesta del servidor.");
        }
      }
    });
  });
</script>
</body>
</html>