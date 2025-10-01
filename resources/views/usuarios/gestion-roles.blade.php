<!DOCTYPE html>

<html lang="es">
<head>
  @php
  use Illuminate\Support\Facades\Auth;
  @endphp
  <meta charset="utf-8" />
  <title>Gestión de Roles de Usuarios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Sistema de gestión de roles de usuarios" />
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
      transform: translateY(-2px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .role-badge {
      padding: 6px 12px;
      border-radius: 50px;
      font-size: 12px;
      font-weight: 600;
    }
    .role-capturador {
      background-color: #e3f2fd;
      color: #1976d2;
    }
    .role-admin {
      background-color: #fff3e0;
      color: #f57c00;
    }
    .role-superadmin {
      background-color: #fce4ec;
      color: #c2185b;
    }
    .table-responsive {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .table th {
      background-color: #f8f9fa;
      font-weight: 600;
      border-bottom: 2px solid #dee2e6;
    }
    .table tbody tr:hover {
      background-color: #f5f9ff !important;
    }
    .btn-role {
      transition: all 0.3s;
    }
    .btn-role:hover {
      transform: translateY(-1px);
    }
  </style>
</head>
<body class="">
<!-- BEGIN #app -->
<div id="app" class="app app-content-full-height app-footer-fixed">

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

        <div class="menu-item">
          <a href="{{ route('usuarios') }}" class="menu-link">
            <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
            <span class="menu-text">Empleados</span>
          </a>
        </div>

        <div class="menu-item active">
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
            <i class="mdi mdi-account-cog me-2 text-primary"></i>Gestión de Roles de Usuarios
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
            <li class="breadcrumb-item"><a href="{{ route('usuarios') }}">Empleados</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestión de Roles</li>
          </ol>
        </nav>
      </section>

      <!-- Resumen en tarjetas -->
      <section class="mb-4">
        <div class="row g-3">
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-account-group text-primary" style="font-size: 2rem;"></i>
                </div>
                <div>
                  <h6 class="card-subtitle mb-1 text-muted">Total Usuarios</h6>
                  <h3 class="card-title mb-0" id="totalUsuarios">-</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-account text-info" style="font-size: 2rem;"></i>
                </div>
                <div>
                  <h6 class="card-subtitle mb-1 text-muted">Capturadores</h6>
                  <h3 class="card-title mb-0" id="totalCapturadores">-</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-account-cog text-warning" style="font-size: 2rem;"></i>
                </div>
                <div>
                  <h6 class="card-subtitle mb-1 text-muted">Administradores</h6>
                  <h3 class="card-title mb-0" id="totalAdmins">-</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-account-star text-danger" style="font-size: 2rem;"></i>
                </div>
                <div>
                  <h6 class="card-subtitle mb-1 text-muted">Super Admins</h6>
                  <h3 class="card-title mb-0" id="totalSuperAdmins">-</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Tabla de usuarios -->
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">
            <i class="mdi mdi-account-cog me-2"></i>Lista de Usuarios y Roles
          </h5>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>CURP</th>
                  <th>Nombre Completo</th>
                  <th>Email</th>
                  <th>Rol Actual</th>
                  <th>Fecha Creación</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="usuariosTableBody">
                @foreach($usuarios as $usuario)
                <tr>
                  <td>
                    <span class="fw-bold text-primary">{{ $usuario->curp }}</span>
                  </td>
                  <td>
                    @if($usuario->empleado)
                      {{ $usuario->empleado->nombre }} {{ $usuario->empleado->apellido_paterno }} {{ $usuario->empleado->apellido_materno }}
                    @else
                      {{ $usuario->username }}
                    @endif
                  </td>
                  <td>
                    @if($usuario->empleado)
                      {{ $usuario->empleado->email }}
                    @else
                      {{ $usuario->email }}
                    @endif
                  </td>
                  <td>
                    @php
                      $roleClass = '';
                      switch($usuario->rol) {
                        case 'capturador':
                          $roleClass = 'role-capturador';
                          break;
                        case 'admin':
                          $roleClass = 'role-admin';
                          break;
                        case 'SuperAdmin':
                          $roleClass = 'role-superadmin';
                          break;
                      }
                    @endphp
                    <span class="role-badge {{ $roleClass }}">
                      <i class="mdi mdi-{{ $usuario->rol === 'capturador' ? 'account' : ($usuario->rol === 'admin' ? 'account-cog' : 'account-star') }} me-1"></i>
                      {{ ucfirst($usuario->rol) }}
                    </span>
                  </td>
                  <td>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                  <td>
                    <button class="btn btn-sm btn-outline-primary btn-role" onclick="cambiarRol('{{ $usuario->curp }}', '{{ $usuario->rol }}')">
                      <i class="mdi mdi-account-edit me-1"></i> Cambiar Rol
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
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

    // Actualizar contadores
    actualizarContadores();
    
    // Establecer el fondo del sidebar mediante JavaScript
    $(".auth-bg-scroll").css("background-image", "url('{{ asset('images/login-bg.jpg') }}')");
    $(".auth-bg-scroll").css("background-size", "cover");
    $(".auth-bg-scroll").css("background-position", "center");
    $(".auth-bg-scroll").css("background-repeat", "no-repeat");
  });

  // Función para actualizar contadores
  function actualizarContadores() {
    const totalUsuarios = $('#usuariosTableBody tr').length;
    const totalCapturadores = $('#usuariosTableBody tr').filter(function() {
      return $(this).find('.role-badge').text().includes('Capturador');
    }).length;
    const totalAdmins = $('#usuariosTableBody tr').filter(function() {
      return $(this).find('.role-badge').text().includes('Admin');
    }).length;
    const totalSuperAdmins = $('#usuariosTableBody tr').filter(function() {
      return $(this).find('.role-badge').text().includes('Superadmin');
    }).length;

    $('#totalUsuarios').text(totalUsuarios);
    $('#totalCapturadores').text(totalCapturadores);
    $('#totalAdmins').text(totalAdmins);
    $('#totalSuperAdmins').text(totalSuperAdmins);
  }

  // Función para cambiar rol
  function cambiarRol(curp, rolActual) {
    Swal.fire({
      title: 'Cambiar Rol de Usuario',
      html: `
        <div class="text-start">
          <p class="mb-3">Selecciona el nuevo rol para el usuario:</p>
          <select id="nuevoRol" class="form-select">
            <option value="">Selecciona un rol...</option>
            <option value="capturador" ${rolActual === 'capturador' ? 'selected' : ''}>Capturador</option>
            <option value="admin" ${rolActual === 'admin' ? 'selected' : ''}>Administrador</option>
            <option value="SuperAdmin" ${rolActual === 'SuperAdmin' ? 'selected' : ''}>Super Administrador</option>
          </select>
        </div>
      `,
      showCancelButton: true,
      confirmButtonColor: '#17a2b8',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Cambiar Rol',
      cancelButtonText: 'Cancelar',
      preConfirm: () => {
        const nuevoRol = document.getElementById('nuevoRol').value;
        if (!nuevoRol) {
          Swal.showValidationMessage('Debes seleccionar un rol');
          return false;
        }
        if (nuevoRol === rolActual) {
          Swal.showValidationMessage('El rol seleccionado es el mismo que tiene actualmente');
          return false;
        }
        return nuevoRol;
      }
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{ url('usuarios') }}/" + curp + "/cambiar-rol",
          type: "POST",
          data: { rol: result.value },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            console.log('Respuesta del servidor:', response);
            Swal.fire(
              '¡Rol Actualizado!',
              'El rol del usuario ha sido cambiado exitosamente.',
              'success'
            );
            
            // Actualizar la fila en la tabla
            actualizarFilaUsuario(curp, result.value);
            
            // Actualizar contadores
            actualizarContadores();
            
            mostrarNotificacion('success', 'Rol actualizado exitosamente');
          },
          error: function(xhr, status, error) {
            console.error('Error al cambiar rol:', { xhr, status, error });
            Swal.fire(
              'Error',
              'No se pudo cambiar el rol del usuario. Por favor, intente nuevamente.',
              'error'
            );
            mostrarNotificacion('error', 'Error al cambiar el rol');
          }
        });
      }
    });
  }

  // Función para actualizar la fila del usuario en la tabla
  function actualizarFilaUsuario(curp, nuevoRol) {
    const fila = $(`#usuariosTableBody tr`).filter(function() {
      return $(this).find('td:first').text().trim() === curp;
    });
    
    if (fila.length > 0) {
      // Actualizar el badge del rol
      const badge = fila.find('.role-badge');
      badge.removeClass('role-capturador role-admin role-superadmin');
      
      let roleClass = '';
      let icon = '';
      
      switch(nuevoRol) {
        case 'capturador':
          roleClass = 'role-capturador';
          icon = 'account';
          break;
        case 'admin':
          roleClass = 'role-admin';
          icon = 'account-cog';
          break;
        case 'SuperAdmin':
          roleClass = 'role-superadmin';
          icon = 'account-star';
          break;
      }
      
      badge.addClass(roleClass);
      badge.html(`<i class="mdi mdi-${icon} me-1"></i>${nuevoRol.charAt(0).toUpperCase() + nuevoRol.slice(1)}`);
      
      // Actualizar el botón
      const boton = fila.find('.btn-role');
      boton.attr('onclick', `cambiarRol('${curp}', '${nuevoRol}')`);
    }
  }
</script>
</body>
</html>
