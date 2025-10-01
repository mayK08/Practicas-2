<!DOCTYPE html>
<html lang="es">
<head>
  @php
  use Illuminate\Support\Facades\Auth;
  @endphp
  <meta charset="utf-8" />
  <title>Declaranet Sonora | Usuarios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <meta name="keywords" content="" />
  <meta name="csrf-token" content="iorh6kkMTq7f5aJ3V9oTu2c0lTCjOcED6fDDzyfi">
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

</head>
<body class="">
<!-- BEGIN #app -->
<div id="app" class="app app-content-full-height app-footer-fixed ">


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
        <div class="menu-item  ">
          <a href="/" class="menu-link">
            <span class="menu-icon"><i class="mdi mdi-view-dashboard-variant-outline"></i></span>
            <span class="menu-text">Inicio</span>
          </a>
        </div>

        <div class="menu-divider"></div>
        <div class="menu-header"><span class="menu-text">Cerrar Sesión</span></div>
        <div class="menu-item  ">
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

    <div class="container-fluid ">

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
            Vista Empleados</h3>


              



          <div class="menu-item dropdown ">
            <a href="#" data-bs-toggle="dropdown" title=" Usuario Verificado " data-bs-display="static" class="menu-link">
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
            <div class="dropdown-menu dropdown-menu-end me-lg-3 py-0 border">


              <a class="dropdown-item d-flex align-items-center" href="{{ url('salir') }}"
                 onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <span class="mdi mdi-exit-to-app fs-4 me-2 text-pink"></span> Salir
              </a>

              <form id="logout-form" action="{{ url('salir') }}" method="POST" class="d-none">
                <input type="hidden" name="_token" value="iorh6kkMTq7f5aJ3V9oTu2c0lTCjOcED6fDDzyfi">                </form>
            </div>
          </div>
        </div>
        <!-- END menu -->
      </div>
      <!-- END #header -->
      <section class="py-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="public">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de Empleados</li>
          </ol>
        </nav>
      </section>

      <section class="py-4">
        <h4 class="mb-3">Listado de Empleados</h4>
        <div id="grid" class="mb-5"></div>
      </section>

      <section class="">
        <section class="system-messages">

          <div class="container-fluid">
            <div>
            </div>
          </div>
        </section>

        <section class="system-error-messages">


        </section>
      </section>



      <div class="">

      </div>

      

      <div class="d-flex justify-content-center">

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
<!-- ================== END BASE JS ================== -->

<script>
  $(document).ready(function() {


    let confKendo = {
      size: "medium",
      rounded: "medium",
      fillMode: "outline"
    }



    function avatarTemplate(id,avatar,email_verified_at)
    {

      let html = "";

      html += ' <div class="position-relative">';

      html += '<img style="width: 2rem" src="images/avatars/'+avatar+'" class="rounded-circle">';

      if(email_verified_at != null)
        html += '<span class="mdi mdi-circle text-success position-absolute top right small" title="Verificado"></span>';
      else
        html += '<span class="mdi mdi-circle text-danger position-absolute top right small" title="No verificado"></span>';

      html += ' </div>';

      return html;

    }

    function onChange(arg) {
      kendoConsole.log("The selected product ids are: [" + this.selectedKeyNames().join(", ") + "]");
    }

    $("#organisms").kendoComboBox(confKendo);
    $("#ages").kendoComboBox(confKendo);


    $("#daterangepicker").kendoDateRangePicker(confKendo);


    $("#dateinput").kendoDatePicker();

    function rangeSliderOnSlide(e) {
      kendoConsole.log("Slide :: new slide values are: " + e.value.toString().replace(",", " - "));
    }

    function rangeSliderOnChange(e) {
      kendoConsole.log("Change :: new values are: " + e.value.toString().replace(",", " - "));
    }


    $("#rangeslider").kendoRangeSlider({
      change: rangeSliderOnChange,
      slide: rangeSliderOnSlide,
      min: 0,
      max: 10,
      smallStep: 1,
      largeStep: 2,
      tickPlacement: "both"
    });



    $("#grid").kendoGrid({
      dataSource: {
        transport: {
          read: {
            url: "{{ route('empleados.recientes') }}",
            type: "GET",
            dataType: "json"
          }
        },
        schema: {
          data: "data",
          total: "total",
          model: {
            id: "curp",
            fields: {
              curp: { type: "string" },
              nombre: { type: "string" },
              apellido_paterno: { type: "string" },
              apellido_materno: { type: "string" },
              num_empleado: { type: "string" },
              puesto: { type: "string" },
              dependencia: { type: "string" },
              updated_at: { type: "date" },
              status: { type: "string" }
            }
          }
        },
        pageSize: 20,
        serverPaging: true,
        serverFiltering: true,
        sort: { field: "updated_at", dir: "desc" }
      },
      pageable: {
        alwaysVisible: true,
        pageSizes: [5, 10, 20, 100],
        refresh: true
      },
      height: 400,
      sortable: {
        mode: "multiple"
      },
      filterable: {
        extra: false,
        operators: {
          string: {
            startswith: "Comienza con",
            eq: "Es igual a",
            neq: "No es igual a"
          }
        }
      },
      persistSelection: true,
      columns: [
        { selectable: true, width: "40px" },
        {
          field: "curp",
          width: 150,
          title: "CURP",
          filterable: {
            cell: {
              operator: "contains",
              suggestionOperator: "contains"
            }
          }
        },
        {
          field: "nombre_completo",
          width: 200,
          title: "Nombre Completo",
          template: "#= apellido_paterno + ' ' + apellido_materno + ' ' + nombre #",
          filterable: {
            cell: {
              operator: "contains",
              suggestionOperator: "contains"
            }
          }
        },
        {
          field: "num_empleado",
          width: 120,
          title: "Número Empleado",
          filterable: {
            cell: {
              operator: "contains",
              suggestionOperator: "contains"
            }
          }
        },
        {
          field: "puesto",
          width: 150,
          title: "Puesto",
          filterable: {
            cell: {
              operator: "contains",
              suggestionOperator: "contains"
            }
          }
        },
        {
          field: "dependencia",
          width: 150,
          title: "Dependencia",
          filterable: {
            cell: {
              operator: "contains",
              suggestionOperator: "contains"
            }
          }
        },
        {
          field: "updated_at",
          width: 150,
          title: "Última Modificación",
          format: "{0:dd/MM/yyyy HH:mm}",
          filterable: false
        },
        {
          field: "status",
          width: 100,
          title: "Estado",
          template: function(dataItem) {
            return dataItem.status === 'Activo' ? 
              '<span class="badge bg-success">Activo</span>' : 
              '<span class="badge bg-danger">Inactivo</span>';
          },
          filterable: {
            cell: {
              operator: "contains",
              suggestionOperator: "contains"
            }
          }
        }
      ]
    });
  });
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.select2Agreements').select2({
          theme: 'bootstrap-5',
          allowClear: true,
          language: 'es',
          escapeMarkup: function(markup) {
            return markup;
          },
          templateResult: function(data) {
            return data.html;
          },
          templateSelection: function(data) {
            return data.text;
          },
          placeholder: 'Buscar un acuerdo por número o descripción',
          ajax: {
            url: '/acuerdos/ajax',
            dataType: 'json',
            method: 'POST',
            delay: 250,
            data: function (params) {
              return {
                term: params.term,
                type: 'agreements'
              }
            },
            processResults: function (data, page) {
              return {
                results: data
              };
            },
          }
        });
        $('.select2Agreements').on('select2:select', function (e) {
          var data = e.params.data;
          window.location = "/acuerdos/"+data.id+"/seguimiento/";
        });
    });
</script>
</body>
</html>