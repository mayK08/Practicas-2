<!DOCTYPE html>
<html lang="es">
<head>
  @php
  use Illuminate\Support\Facades\Auth;
  @endphp
  <meta charset="utf-8" />
  <title>Solicitudes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Sistema de gestión de solicitudes para Declaranet Sonora" />
  <meta name="author" content="Gobierno del Estado de Sonora" />
  <meta name="keywords" content="declaranet, solicitudes, transparencia, gobierno, sonora" />
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
  
  <!-- Sweetalert2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  
  <!-- Estilos personalizados -->
  <style>
    :root {
      --primary-color: #1976D2;
      --secondary-color: #F59E0B;
      --success-color: #10B981;
      --danger-color: #EF4444;
      --light-bg: #F9FAFB;
    }
    
    body {
      background-color: var(--light-bg);
    }
    
    .app-sidebar {
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    
    .card {
      border: none;
      box-shadow: 0 4px 6px rgba(0,0,0,0.05);
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    
    .card:hover {
      box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }
    
    .card-header {
      background-color: white;
      border-bottom: 1px solid rgba(0,0,0,0.05);
      padding: 1rem 1.5rem;
      border-radius: 8px 8px 0 0 !important;
    }
    
    .nav-tabs .nav-link {
      border: none;
      color: #64748B;
      padding: 0.75rem 1.25rem;
      border-radius: 6px;
      font-weight: 600;
      transition: all 0.2s ease;
    }
    
    .nav-tabs .nav-link:hover {
      color: var(--primary-color);
      background-color: rgba(25, 118, 210, 0.05);
    }
    
    .nav-tabs .nav-link.active {
      color: var(--primary-color);
      background-color: rgba(25, 118, 210, 0.1);
      border-bottom: 3px solid var(--primary-color);
    }
    
    .badge {
      padding: 0.35em 0.65em;
      font-size: 0.75em;
      font-weight: 600;
      border-radius: 6px;
    }
    
    .badge.bg-warning {
      background-color: var(--secondary-color) !important;
    }
    
    .badge.bg-success {
      background-color: var(--success-color) !important;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
    
    .btn-danger {
      background-color: var(--danger-color);
      border-color: var(--danger-color);
    }
    
    .page-header {
      font-weight: 700;
      margin-bottom: 0;
    }
    
    /* Animaciones para las tablas */
    .k-grid-content tr {
      transition: all 0.2s ease;
    }
    
    .k-grid-content tr:hover {
      background-color: rgba(25, 118, 210, 0.05) !important;
      transform: translateY(-2px);
    }
    
    /* Estilos para las tablas Kendo */
    .k-grid {
      border-radius: 8px;
      overflow: hidden;
      border: none;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .k-grid-header {
      background-color: #F8FAFC;
    }
    
    .k-grid-header th {
      font-weight: 600;
      color: #334155;
    }
    
    .k-pager-wrap {
      background-color: white;
      border-top: 1px solid rgba(0,0,0,0.05);
    }
    
    /* Ajustes para mejor visualización de tablas */
    #gridPendientes, #gridAceptadas {
      min-height: 550px;
      height: auto !important;
    }
    
    .k-grid-content {
      min-height: 450px;
    }
    
    .k-grid td {
      padding: 0.75rem 0.5rem;
      vertical-align: middle;
      line-height: 1.5;
    }
    
    .k-grid-header th.k-header {
      padding: 0.85rem 0.5rem;
      text-transform: uppercase;
      font-size: 0.85rem;
      letter-spacing: 0.5px;
    }
    
    /* Personalización del botón de scroll */
    .btn-scroll-top {
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--primary-color);
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    
    /* Mejoras responsivas */
    @media (max-width: 768px) {
      .card-body {
        padding: 1rem;
      }
      
      .page-header {
        font-size: 1.5rem;
      }
    }
  </style>
  <!-- ================== END BASE CSS STYLE ================== -->
</head>
<body>
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
        <div class="menu-header"><span class="menu-text">Páginas</span></div>

        <div class="menu-item active">
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
          <h3 class="page-header">Gestión de Solicitudes</h3>

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
            <div class="dropdown-menu dropdown-menu-end me-lg-3 py-0 border shadow-sm rounded-3">

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

      <section class="py-4">
        <!-- Resumen de solicitudes -->
        <div class="row mb-4">
          <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-clipboard-text-outline text-primary fs-4"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Total Solicitudes</h6>
                  <h4 class="mb-0">{{ $solicitudesPendientes->count() + $solicitudesAceptadas->count() + $solicitudesRechazadas->count() }}</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
            <div class="card h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-clock-outline text-warning fs-4"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Pendientes</h6>
                  <h4 class="mb-0">{{ $solicitudesPendientes->count() }}</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-3 mb-md-0">
            <div class="card h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-check-circle-outline text-success fs-4"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Aceptadas</h6>
                  <h4 class="mb-0">{{ $solicitudesAceptadas->count() }}</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-3 mb-md-0">
            <div class="card h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-close-circle-outline text-danger fs-4"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Rechazadas</h6>
                  <h4 class="mb-0">{{ $solicitudesRechazadas->count() }}</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card h-100">
              <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                  <i class="mdi mdi-calendar-month-outline text-danger fs-4"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Este Mes</h6>
                  <h4 class="mb-0">{{ $solicitudesPendientes->count() + $solicitudesAceptadas->count() + $solicitudesRechazadas->count() }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active d-flex align-items-center" data-bs-toggle="tab" href="#pendientes" role="tab">
                  <span class="mdi mdi-clock-outline me-2"></span> Pendientes
                  <span class="badge bg-warning ms-2">{{ $solicitudesPendientes->count() }}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center" data-bs-toggle="tab" href="#aceptadas" role="tab">
                  <span class="mdi mdi-check-circle-outline me-2"></span> Aceptadas
                  <span class="badge bg-success ms-2">{{ $solicitudesAceptadas->count() }}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link d-flex align-items-center" data-bs-toggle="tab" href="#rechazadas" role="tab">
                  <span class="mdi mdi-close-circle-outline me-2"></span> Rechazadas
                  <span class="badge bg-danger ms-2">{{ $solicitudesRechazadas->count() }}</span>
                </a>
              </li>
            </ul>
            <div class="d-none d-md-block">
              <button class="btn btn-sm btn-outline-primary me-2">
                <i class="mdi mdi-printer"></i> Imprimir
              </button>
              <button class="btn btn-sm btn-outline-success">
                <i class="mdi mdi-file-excel"></i> Exportar
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane fade show active" id="pendientes" role="tabpanel">
                <div id="gridPendientes"></div>
              </div>
              <div class="tab-pane fade" id="aceptadas" role="tabpanel">
                <div id="gridAceptadas"></div>
              </div>
              <div class="tab-pane fade" id="rechazadas" role="tabpanel">
                <div id="gridRechazadas"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- END #app -->

<!-- BEGIN btn-scroll-top -->
<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
<!-- END btn-scroll-top -->

<!-- Templates para Kendo UI Grid -->
<script id="accionTemplate" type="text/x-kendo-template">
  <div class="action-buttons text-center">
    <button class="k-button k-button-solid-primary k-button-md btn-aprobar" data-item-id="#= id #" title="Aprobar">
      <i class="mdi mdi-check"></i>
    </button>
    <button class="k-button k-button-solid-error k-button-md ms-2 btn-rechazar" data-item-id="#= id #" title="Rechazar">
      <i class="mdi mdi-close"></i>
    </button>
  </div>
</script>

<!-- Template para motivo de rechazo -->
<script id="motivoRechazoTemplate" type="text/x-kendo-template">
  <div>
    <button class="k-button k-button-solid-primary k-button-md btn-ver-motivo" 
            data-item-id="#= id #" 
            data-motivo="#= motivo_rechazo #" 
            title="Ver Motivo">
      <i class="mdi mdi-comment-text-outline"></i>
    </button>
  </div>
</script>

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('js/plugins/telerik-ui/js/kendo.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- ================== END BASE JS ================== -->

<script>
  // Configuración global de AJAX para mostrar errores en la consola
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    error: function(xhr, status, error) {
      console.error('Error en petición AJAX:', {
        status: status,
        error: error,
        response: xhr.responseText
      });
    }
  });

  $(document).ready(function() {
    // Variables para rutas
    const baseUrl = window.location.origin;
    const aprobarUrl = (id) => `${baseUrl}/solicitudes/${id}/aprobar`;
    const rechazarUrl = (id) => `${baseUrl}/solicitudes/${id}/rechazar`;
    
    // Verificar si las rutas son accesibles
    console.log('Configuración de rutas:', { 
      baseUrl,
      ejemploAprobarUrl: aprobarUrl('123'),
      ejemploRechazarUrl: rechazarUrl('123')
    });

    // Configuración común para las grids
    const gridDefaults = {
      height: 550,
      sortable: true,
      filterable: {
        mode: "row"
      },
      pageable: {
        alwaysVisible: true,
        pageSizes: [10, 20, 50, 100],
        refresh: true,
        buttonCount: 5
      },
      columnMenu: true,
      resizable: true,
      navigatable: true,
      selectable: "row",
      noRecords: {
        template: "<div class='text-center p-4'><i class='mdi mdi-database-search-outline fs-2 text-muted'></i><p class='mt-2'>No se encontraron registros</p></div>"
      },
      messages: {
        noRecords: "No hay registros disponibles.",
        loading: "Cargando...",
        requestFailed: "La solicitud falló.",
        retry: "Reintentar",
        commands: {
          cancel: "Cancelar",
          canceledit: "Cancelar",
          create: "Agregar nuevo registro",
          destroy: "Eliminar",
          edit: "Editar",
          save: "Guardar",
          select: "Seleccionar",
          update: "Actualizar"
        }
      }
    };

    // Configuración de la grid para solicitudes pendientes
    $("#gridPendientes").kendoGrid({
      ...gridDefaults,
      dataSource: {
        data: @json($solicitudesPendientes),
        schema: {
          model: {
            id: "id",
            fields: {
              id: { type: "number" },
              curp: { type: "string" },
              nombre_completo: { type: "string" },
              num_empleado: { type: "string" },
              puesto: { type: "string" },
              dependencia: { type: "string" },
              created_at: { type: "date" },
              solicitud_status: { type: "string" }
            }
          }
        },
        pageSize: 10
      },
      columns: [
        { selectable: true, width: "35px" },
        {
          field: "curp",
          title: "CURP",
          width: 180
        },
        {
          field: "nombre_completo",
          title: "Nombre Completo",
          template: "#= apellido_paterno + ' ' + apellido_materno + ' ' + nombre #",
          width: 250
        },
        {
          field: "num_empleado",
          title: "Número Empleado",
          width: 130
        },
        {
          field: "puesto",
          title: "Puesto",
          width: 180
        },
        {
          field: "dependencia",
          title: "Dependencia",
          width: 180
        },
        {
          field: "created_at",
          title: "Fecha Solicitud",
          format: "{0:dd/MM/yyyy}",
          width: 130
        },
        {
          field: "solicitud_status",
          title: "Estado",
          template: '<span class="badge bg-warning px-3 py-2"><i class="mdi mdi-clock-outline me-1"></i>Pendiente</span>',
          width: 120,
          attributes: {
            class: "text-center"
          }
        },
        {
          field: "acciones",
          title: "Acciones",
          width: 130,
          template: kendo.template($("#accionTemplate").html()),
          attributes: {
            class: "text-center"
          }
        }
      ],
      dataBound: function() {
        console.log("Grid pendientes inicializada. Configurando eventos...");
        // Tooltip para botones
        $(".k-button").kendoTooltip({
          position: "top"
        });
        
        // Recorrer cada fila y configurar los botones de acción
        var grid = this;
        var rows = grid.tbody.find("tr");
        rows.each(function(index) {
          var dataItem = grid.dataItem(this);
          if (!dataItem || !dataItem.id) return;
          
          var id = dataItem.id;
          console.log("Configurando botones para la fila con ID:", id);
          
          // Buscar botones dentro de esta fila
          var btnAprobar = $(this).find(".btn-aprobar");
          var btnRechazar = $(this).find(".btn-rechazar");
          
          // Asignar el ID como atributo data
          btnAprobar.attr("data-item-id", id);
          btnRechazar.attr("data-item-id", id);
          
          // Configurar manejadores de eventos
          btnAprobar.off("click").on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Clic en aprobar para ID:", id);
            aprobarSolicitud(id);
            return false;
          });
          
          btnRechazar.off("click").on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Clic en rechazar para ID:", id);
            rechazarSolicitud(id);
            return false;
          });
        });
      }
    });

    // Configuración de la grid para solicitudes aceptadas
    $("#gridAceptadas").kendoGrid({
      ...gridDefaults,
      dataSource: {
        data: @json($solicitudesAceptadas),
        schema: {
          model: {
            id: "id",
            fields: {
              id: { type: "number" },
              curp: { type: "string" },
              nombre_completo: { type: "string" },
              num_empleado: { type: "string" },
              puesto: { type: "string" },
              dependencia: { type: "string" },
              updated_at: { type: "date" },
              solicitud_status: { type: "string" }
            }
          }
        },
        pageSize: 10
      },
      columns: [
        { selectable: true, width: "35px" },
        {
          field: "curp",
          title: "CURP",
          width: 180
        },
        {
          field: "nombre_completo",
          title: "Nombre Completo",
          template: "#= apellido_paterno + ' ' + apellido_materno + ' ' + nombre #",
          width: 250
        },
        {
          field: "num_empleado",
          title: "Número Empleado",
          width: 130
        },
        {
          field: "puesto",
          title: "Puesto",
          width: 180
        },
        {
          field: "dependencia",
          title: "Dependencia",
          width: 180
        },
        {
          field: "updated_at",
          title: "Fecha Aceptación",
          format: "{0:dd/MM/yyyy}",
          width: 130
        },
        {
          field: "solicitud_status",
          title: "Estado",
          template: '<span class="badge bg-success px-3 py-2"><i class="mdi mdi-check-circle-outline me-1"></i>Aceptado</span>',
          width: 130,
          attributes: {
            class: "text-center"
          }
        },
        {
          command: [
            {
              name: "ver",
              text: "",
              template: '<button class="k-button k-button-solid-primary k-button-md" title="Ver Detalles"><i class="mdi mdi-eye"></i></button>',
              click: function(e) {
                e.preventDefault();
                var tr = $(e.target).closest("tr");
                var data = this.dataItem(tr);
                // Mostrar detalles
                Swal.fire({
                  title: 'Detalles de la Solicitud',
                  html: `
                    <div class="text-start fs-6">
                      <p><strong>CURP:</strong> ${data.curp}</p>
                      <p><strong>Nombre:</strong> ${data.apellido_paterno} ${data.apellido_materno} ${data.nombre}</p>
                      <p><strong>Número Empleado:</strong> ${data.num_empleado}</p>
                      <p><strong>Puesto:</strong> ${data.puesto}</p>
                      <p><strong>Dependencia:</strong> ${data.dependencia}</p>
                      <p><strong>Fecha Aceptación:</strong> ${kendo.toString(data.updated_at, "dd/MM/yyyy")}</p>
                    </div>
                  `,
                  width: '600px',
                  confirmButtonText: 'Cerrar',
                  confirmButtonColor: '#1976D2'
                });
              }
            }
          ],
          title: "Acciones",
          width: 100,
          attributes: {
            class: "text-center"
          }
        }
      ],
      dataBound: function() {
        console.log("Grid aceptadas inicializada. Configurando eventos...");
        // Tooltip para botones
        $(".k-button").kendoTooltip({
          position: "top"
        });
        
        // Recorrer cada fila y configurar los botones de acción
        var grid = this;
        var rows = grid.tbody.find("tr");
        rows.each(function(index) {
          var dataItem = grid.dataItem(this);
          if (!dataItem || !dataItem.id) return;
          
          var id = dataItem.id;
          console.log("Configurando botones para la fila con ID:", id);
          
          // Buscar botones dentro de esta fila
          var btnAprobar = $(this).find(".btn-aprobar");
          var btnRechazar = $(this).find(".btn-rechazar");
          
          // Asignar el ID como atributo data
          btnAprobar.attr("data-item-id", id);
          btnRechazar.attr("data-item-id", id);
          
          // Configurar manejadores de eventos
          btnAprobar.off("click").on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Clic en aprobar para ID:", id);
            aprobarSolicitud(id);
            return false;
          });
          
          btnRechazar.off("click").on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Clic en rechazar para ID:", id);
            rechazarSolicitud(id);
            return false;
          });
        });
      }
    });

    // Configuración de la grid para solicitudes rechazadas
    $("#gridRechazadas").kendoGrid({
      ...gridDefaults,
      dataSource: {
        data: @json($solicitudesRechazadas),
        schema: {
          model: {
            id: "id",
            fields: {
              id: { type: "number" },
              curp: { type: "string" },
              nombre_completo: { type: "string" },
              num_empleado: { type: "string" },
              puesto: { type: "string" },
              dependencia: { type: "string" },
              updated_at: { type: "date" },
              solicitud_status: { type: "string" },
              motivo_rechazo: { type: "string" }
            }
          }
        },
        pageSize: 10
      },
      columns: [
        { selectable: true, width: "35px" },
        {
          field: "curp",
          title: "CURP",
          width: 180
        },
        {
          field: "nombre_completo",
          title: "Nombre Completo",
          template: "#= apellido_paterno + ' ' + apellido_materno + ' ' + nombre #",
          width: 250
        },
        {
          field: "num_empleado",
          title: "Número Empleado",
          width: 130
        },
        {
          field: "puesto",
          title: "Puesto",
          width: 180
        },
        {
          field: "dependencia",
          title: "Dependencia",
          width: 180
        },
        {
          field: "updated_at",
          title: "Fecha Rechazo",
          format: "{0:dd/MM/yyyy}",
          width: 130
        },
        {
          field: "solicitud_status",
          title: "Estado",
          template: '<span class="badge bg-danger px-3 py-2"><i class="mdi mdi-close-circle-outline me-1"></i>Rechazado</span>',
          width: 130,
          attributes: {
            class: "text-center"
          }
        },
        {
          title: "Motivo",
          width: 100,
          template: '<button class="k-button k-button-solid-primary k-button-md btn-ver-motivo" data-bs-toggle="tooltip" title="Ver Motivo"><i class="mdi mdi-comment-text-outline"></i></button>',
          attributes: {
            class: "text-center"
          }
        }
      ],
      dataBound: function() {
        console.log("Grid rechazadas inicializada. Configurando eventos...");
        // Tooltip para botones
        $(".k-button").kendoTooltip({
          position: "top"
        });
        
        // Recorrer cada fila y configurar los botones para ver motivo
        var grid = this;
        var rows = grid.tbody.find("tr");
        rows.each(function(index) {
          var dataItem = grid.dataItem(this);
          if (!dataItem || !dataItem.id) return;
          
          var id = dataItem.id;
          var motivo = dataItem.motivo_rechazo || "No se especificó motivo";
          console.log("Configurando botón ver motivo para la fila con ID:", id);
          
          // Buscar botón dentro de esta fila
          var btnVerMotivo = $(this).find(".btn-ver-motivo");
          
          // Asignar datos como atributos
          btnVerMotivo.attr("data-id", id);
          btnVerMotivo.attr("data-motivo", motivo);
          
          // Configurar manejadores de eventos
          btnVerMotivo.off("click").on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log("Mostrando motivo para ID:", id);
            
            Swal.fire({
              title: 'Motivo del Rechazo',
              html: `
                <div class="text-start fs-6">
                  <p><strong>CURP:</strong> ${dataItem.curp || 'No disponible'}</p>
                  <p><strong>Nombre:</strong> ${dataItem.apellido_paterno} ${dataItem.apellido_materno} ${dataItem.nombre}</p>
                  <p><strong>Fecha Rechazo:</strong> ${kendo.toString(dataItem.updated_at, "dd/MM/yyyy")}</p>
                  <hr>
                  <p><strong>Motivo:</strong></p>
                  <div class="alert alert-danger p-3">
                    ${motivo}
                  </div>
                </div>
              `,
              width: '600px',
              confirmButtonText: 'Cerrar',
              confirmButtonColor: '#1976D2'
            });
            
            return false;
          });
        });
      }
    });

    // Colocar las funciones en el alcance global para que estén disponibles para los onclick
    window.aprobarSolicitud = aprobarSolicitud;
    window.rechazarSolicitud = rechazarSolicitud;

    // Función para aprobar solicitud
    function aprobarSolicitud(id) {
      if (!id) {
        console.error('Error: ID no válido', id);
        Swal.fire({
          title: 'Error',
          text: 'ID no válido o vacío. Por favor, refresque la página e intente nuevamente.',
          icon: 'error',
          confirmButtonColor: '#EF4444'
        });
        return;
      }
      
      // Depuración extra para identificar el problema
      console.log("ID:", id);

      console.log("Iniciando aprobación de solicitud con ID:", id);
      Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Deseas aprobar esta solicitud?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#10B981',
        cancelButtonColor: '#64748B',
        confirmButtonText: 'Sí, aprobar',
        cancelButtonText: 'Cancelar',
        background: '#fff',
        iconColor: '#F59E0B',
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false
      }).then((result) => {
        if (result.isConfirmed) {
          // Mostrar cargando
          Swal.fire({
            title: 'Procesando',
            text: 'Aprobando la solicitud...',
            icon: 'info',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            willOpen: () => {
              Swal.showLoading();
            }
          });

          const token = $('meta[name="csrf-token"]').attr('content');
          if (!token) {
            console.error('Error: No se pudo obtener el token CSRF');
            Swal.fire({
              title: 'Error',
              text: 'Error de seguridad: No se pudo obtener el token CSRF',
              icon: 'error',
              confirmButtonColor: '#EF4444'
            });
            return;
          }

          $.ajax({
            url: aprobarUrl(id),
            type: "POST",
            headers: {
              'X-CSRF-TOKEN': token
            },
            dataType: 'json',
            beforeSend: function() {
              console.log(`Enviando solicitud de aprobación a: ${aprobarUrl(id)}`);
            },
            success: function(response) {
              console.log("Respuesta exitosa:", response);
              Swal.fire({
                title: '¡Aprobado!',
                text: 'La solicitud ha sido aprobada con éxito.',
                icon: 'success',
                confirmButtonColor: '#10B981',
                customClass: {
                  confirmButton: 'btn btn-success'
                },
                buttonsStyling: false
              }).then(() => {
                window.location.reload();
              });
            },
            error: function(xhr, status, error) {
              console.error("Error en la solicitud:", { xhr, status, error });
              let errorMsg = 'No se pudo aprobar la solicitud.';
              if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
              }
              // Si hay un mensaje de error en la respuesta, usarlo
              try {
                const response = JSON.parse(xhr.responseText);
                if (response && response.message) {
                  errorMsg = response.message;
                }
              } catch (e) {
                console.error('Error al parsear la respuesta del servidor:', e);
              }
              Swal.fire({
                title: 'Error',
                text: errorMsg + ' Intente de nuevo más tarde.',
                icon: 'error',
                confirmButtonColor: '#EF4444',
                customClass: {
                  confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
              });
            }
          });
        }
      });
    }

    // Función para rechazar solicitud
    function rechazarSolicitud(id) {
      if (!id) {
        console.error('Error: ID no válido', id);
        Swal.fire({
          title: 'Error',
          text: 'ID no válido o vacío. Por favor, refresque la página e intente nuevamente.',
          icon: 'error',
          confirmButtonColor: '#EF4444'
        });
        return;
      }

      console.log("Iniciando rechazo de solicitud con ID:", id);
      Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Deseas rechazar esta solicitud?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#64748B',
        confirmButtonText: 'Sí, rechazar',
        cancelButtonText: 'Cancelar',
        background: '#fff',
        iconColor: '#F59E0B',
        customClass: {
          confirmButton: 'btn btn-danger',
          cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false
      }).then((result) => {
        if (result.isConfirmed) {
          // Pedir motivo de rechazo
          Swal.fire({
            title: 'Motivo del rechazo',
            input: 'textarea',
            inputLabel: 'Por favor, ingrese el motivo del rechazo:',
            inputPlaceholder: 'Escriba el motivo aquí...',
            inputAttributes: {
              'aria-label': 'Motivo del rechazo'
            },
            showCancelButton: true,
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#64748B',
            customClass: {
              confirmButton: 'btn btn-danger',
              cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false,
            preConfirm: (motivo) => {
              if (!motivo) {
                Swal.showValidationMessage('Debe ingresar un motivo para rechazar la solicitud');
              }
              return motivo;
            }
          }).then((result) => {
            if (result.isConfirmed) {
              const motivo = result.value;
              
              // Mostrar cargando
              Swal.fire({
                title: 'Procesando',
                text: 'Rechazando la solicitud...',
                icon: 'info',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                willOpen: () => {
                  Swal.showLoading();
                }
              });
              
              $.ajax({
                url: rechazarUrl(id),
                type: "POST",
                data: {
                  motivo: motivo
                },
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                beforeSend: function() {
                  console.log(`Enviando solicitud de rechazo a: ${rechazarUrl(id)}`);
                },
                success: function(response) {
                  console.log("Respuesta exitosa:", response);
                  Swal.fire({
                    title: '¡Rechazado!',
                    text: 'La solicitud ha sido rechazada correctamente.',
                    icon: 'success',
                    confirmButtonColor: '#10B981',
                    customClass: {
                      confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                  }).then(() => {
                    window.location.reload();
                  });
                },
                error: function(xhr, status, error) {
                  console.error("Error en la solicitud:", { xhr, status, error });
                  let errorMsg = 'No se pudo rechazar la solicitud.';
                  if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                  }
                  Swal.fire({
                    title: 'Error',
                    text: errorMsg + ' Intente de nuevo más tarde.',
                    icon: 'error',
                    confirmButtonColor: '#EF4444',
                    customClass: {
                      confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                  });
                }
              });
            }
          });
        }
      });
    }
    
    // Aplicar efectos de animación a las pestañas
    $('.nav-tabs .nav-link').on('click', function() {
      $('.nav-tabs .nav-link').removeClass('active');
      $(this).addClass('active');
    });
    
    // Tooltip para botones de acción
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // Ajustar tamaño de grid al cambiar de pestaña
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
      setTimeout(function() {
        $(window).trigger('resize');
      }, 100);
    });
    
    // Asegurar que la tabla se ajuste al contenedor
    $(window).on('resize', function() {
      $("#gridPendientes").data("kendoGrid").resize();
      $("#gridAceptadas").data("kendoGrid").resize();
      $("#gridRechazadas").data("kendoGrid").resize();
    });
    
    // Verificar si los botones existen en el DOM después de cargar la página
    setTimeout(function() {
      console.log('Botones de aprobar encontrados:', $('.btn-aprobar').length);
      console.log('Botones de rechazar encontrados:', $('.btn-rechazar').length);
    }, 1000);
  });
</script>
</body>
</html> 
