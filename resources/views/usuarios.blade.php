<!DOCTYPE html>
<html lang="es">
<head>
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


        <a class="brand-logo" href="{{ url('/') }}" title="Declaranet">
          <img src="{{ asset('images/escudo-sonora-blanco.svg') }}" class="logo" alt="Declaranet">
          <h1>Declaranet</h1>
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
        <div class="menu-divider"></div><div class="menu-header"><span class="menu-text">Pagina</span></div>

        <div class="menu-item  ">
          <a href="/usuarios" class="menu-link">
            <span class="menu-icon"><i class="mdi mdi-book-clock-outline"></i></span>
            <span class="menu-text">Solicitudes</span>

          </a>

        </div>
        
        



        
        
        
        <div class="menu-divider"></div><div class="menu-header"><span class="menu-text">Cerrar Sesión</span></div>
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
            Solicitudes         </h3>


              



          <div class="menu-item dropdown ">
            <a href="#" data-bs-toggle="dropdown" title=" Usuario Verificado " data-bs-display="static" class="menu-link">
              <div class="menu-img">
                <i class="mdi mdi-account-circle-outline"></i>
              </div>

              <div class="menu-text lh-1">

                Miguel Romero  <span class="mdi mdi-chevron-down"></span>
                <small class="d-block fw-normal">miguel.romero@sonora.gob.mx</small>

              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-lg-3 py-0 border">
              <a class="dropdown-item d-flex align-items-center" href="{{ url('perfil') }}">
                <span class="mdi mdi-account-circle fs-4 me-2 text-pink"></span> Mi perfil
              </a>
              <div class="dropdown-divider my-0"></div>

              <a class="dropdown-item d-flex align-items-center" href="{{ url('perfil') }}">
                <i class="mdi mdi-face-agent fs-4 me-2 text-pink"></i> Soporte
              </a>
              <div class="dropdown-divider my-0"></div>




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


            <li class="breadcrumb-item active" aria-current="page">Solicitudes</li>

          </ol>
        </nav>

      </section>

      <section class="bg-light app-filters">


        <form method="POST" action="public/usuarios" accept-charset="UTF-8" autocomplete="off"><input name="_token" type="hidden" value="iorh6kkMTq7f5aJ3V9oTu2c0lTCjOcED6fDDzyfi">
          <div class="row g-3">

            <div class="col-12 col-sm-3">
              <label for="name" class="form-label">Nombres</label>
              <input class="form-control" placeholder="Nombres" name="name" type="text">
            </div>
            <div class="col-12 col-sm-3">
              <label for="name" class="form-label">Apellidos</label>
              <input class="form-control" placeholder="Apellidos" name="name" type="text">
            </div>

            <div class="col-12 col-sm-3">
              <label for="name" class="form-label">Correo Electrónico</label>
              <input class="form-control" placeholder="Correo Electrónico" name="name" type="text">
            </div>




            <div class="col-6 col-sm-3">
              <label for="dateinput" class="form-label">Fecha de ingreso</label>
              <input id="dateinput" title="Fecha">
            </div>




            <div class="col-6 col-sm-3">
              <label for="role" class="form-label">Roles de Usuario</label>
              <select class="form-select picker" name="role"><option value="" selected="selected">Roles de Usuario</option><option value="2">Administrador</option><option value="3">Enlace</option><option value="1">Super Usuario</option></select>
            </div>




            <div class="col-6 col-sm-3">
              <label for="ages" class="form-label">Edades</label>
              <select id="ages" placeholder="Selecciona un rango de edad...">
                <option>18-30</option>
                <option>31-40</option>
                <option>41-50</option>
                <option>51-60</option>
                <option>61-70</option>
                <option>70 y más</option>
              </select>
            </div>

            <!-- Columna responsiva para ingreso de números -->
              <div class="col-12 col-sm-3">
                <!-- Etiqueta para el campo numérico -->
                <label for="numberInput" class="form-label">Número</label>
                <!-- Campo de entrada de tipo número -->
                <input class="form-control" placeholder="Ingresa un número" name="numberInput" id="numberInput" type="text">
              </div>





            <div class="col-12 col-sm-3 text-end pt-4">
              <a href="public/usuarios" class="btn btn-sm btn-default">Reestablecer</a>
              <input class="btn btn-sm btn-info" type="submit" value="Filtrar">
            </div>


            

          <!-- aqui van las dependencias en caso de que se necesiten) -->


           




            



          </div>
        </form>

      </section>

      <section class="py-4">


        <div class="row">
          <div class="col-sm-8">
            <a class="btn btn-success btn-sm" href="{{ url('usuarios/crear') }}" title="Nuevo Usuario">
              <span class="mdi mdi-plus"></span> Agregar
            </a>

            <a href="#" class="btn btn-warning btn-sm">
              <i class="mdi mdi-file-document-edit"></i> Editar
            </a>

            <a data-message="¿Esta seguro de eliminar este registro?"
               href="#" class="btn btn-danger btn-confirm btn-sm">
              <i class="mdi mdi-trash-can"></i> Eliminar
            </a>


            <a class="btn btn-outline-success btn-sm" href="public/usuarios/crear" title="Nuevo Usuario">
              <span class="mdi mdi-check-circle"></span> Aprobar
            </a>

            <a class="btn btn-outline-danger btn-sm" href="public/usuarios/crear" title="Nuevo Usuario">
              <span class="mdi mdi-cancel"></span> Rechazar
            </a>
          </div>

          <div class="col-sm-4 text-end">
            Exportar a:

            <a class="btn btn-outline-success btn-sm px-3" href="public/usuarios/crear" title="Nuevo Usuario">
              <span class="mdi mdi-microsoft-excel"></span> Excel
            </a>

            <a class="btn btn-outline-danger btn-sm px-3" href="public/usuarios/crear" title="Nuevo Usuario">
              <span class="mdi mdi-file-pdf-box"></span> PDF
            </a>


          </div>

        </div>





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

      <div id="grid"></div>

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
        //type: "json",
        data: [{"id":1,"name":"Miguel Romero","email":"miguel.romero@sonora.gob.mx","avatar":"default.png","email_verified_at":"2022-05-06T22:48:32.000000Z"}],
        schema: {
          model: {
            id: "id",
            fields: {
              id: { type: "number" },
              avatar: { type: "string" },
              name: { type: "string" },
              email: { type: "string" },
              email_verified_at: { type: "date" },

              //Rol: { type: "string" },
              //ShipCity: { type: "string" }
            }
          }
        },
        pageSize: 20,

        serverPaging: false,
        serverFiltering: true,

      },
      pageable: {
        alwaysVisible: true,
        pageSizes: [5, 10, 20, 100]
      },
      height: 400,
      filterable: {
        mode: "row"
      },

      sortable: {
        mode: "multiple"
      },

      filterable: {
        extra: false,
        operators: {
          string: {
            startswith: "Starts with",
            eq: "Is equal to",
            neq: "Is not equal to"
          }
        }
      },

      persistSelection: true,
      change: onChange,
      columns: [
            { selectable: true, width: "40px" },
           
            {
              field: "name",
              width: 255,
              title: "Nombre",
              filterable: {
                cell: {
                  operator: "contains",
                  suggestionOperator: "contains"
                }
              }
            },{
            field: "email",
            width: 255,
            title: "Correo Electrónico",
            filterable: {
              cell: {
                operator: "gte"
              }
            }
          },{
            field: "email_verified_at",
            width: 190,
            title: "Fecha de Ingreso",
            format: "{0:MM/dd/yyyy}"
          },
          {
            field: "numberInput",
            width: 200,
            title: "Numero Telefono",
            format: "{0:Rol del usuario}"
          },
          {
            field: "Rol del usuario",
            width: 200,
            title: "Rol del usuario",
            format: "{0:Rol del usuario}"
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