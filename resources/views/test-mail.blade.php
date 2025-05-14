<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prueba de Correo - Declaranet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="mdi mdi-email-outline me-2"></i>Prueba de Envío de Correo</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="mdi mdi-information-outline me-2"></i>
                            Utiliza este formulario para probar si el sistema de correos está funcionando correctamente.
                        </div>
                        
                        <div id="result-container" class="my-3 d-none">
                            <!-- Aquí se mostrará el resultado del envío -->
                        </div>
                        
                        <form id="test-mail-form">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico Destinatario</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           placeholder="ejemplo@correo.com" required>
                                </div>
                                <div class="form-text">El correo de prueba será enviado a esta dirección.</div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-send me-2"></i>Enviar Correo de Prueba
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-2"></i>Volver
                            </a>
                            
                            <div>
                                <span class="text-muted">Estado del servidor de correos:</span>
                                <span id="mail-status" class="badge bg-secondary">No verificado</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow mt-4">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0"><i class="mdi mdi-help-circle-outline me-2"></i>Solución de Problemas</h4>
                    </div>
                    <div class="card-body">
                        <p>Si no recibes los correos, verifica la siguiente configuración:</p>
                        <ol>
                            <li>Revisa que en tu archivo <code>.env</code> estén correctamente configuradas las variables <code>MAIL_*</code></li>
                            <li>Para Gmail, usa <code>MAIL_HOST=smtp.gmail.com</code> y <code>MAIL_PORT=587</code></li>
                            <li>Si usas Gmail, debes crear una "Contraseña de aplicación" específica</li>
                            <li>Verifica que no estén bloqueados por el firewall los puertos 587 o 465</li>
                            <li>Revisa la carpeta de spam en tu correo</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            // Configurar CSRF para AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Manejar el envío del formulario
            $('#test-mail-form').on('submit', function(e) {
                e.preventDefault();
                
                const email = $('#email').val();
                
                // Mostrar indicador de carga
                Swal.fire({
                    title: 'Enviando correo...',
                    html: 'Por favor espera mientras se envía el correo a <b>' + email + '</b>',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Realizar la petición AJAX
                $.ajax({
                    url: '{{ route("test.mail") }}',
                    type: 'POST',
                    data: {
                        email: email
                    },
                    success: function(response) {
                        console.log('Respuesta:', response);
                        
                        // Actualizar UI
                        $('#mail-status').removeClass('bg-secondary').addClass('bg-success').text('Funcionando');
                        
                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: '¡Correo enviado!',
                            html: 'Se ha enviado un correo de prueba a <b>' + email + '</b>.<br>Por favor verifica tu bandeja de entrada.'
                        });
                        
                        // Mostrar resultado
                        $('#result-container').removeClass('d-none alert-danger').addClass('alert alert-success').html(
                            '<i class="mdi mdi-check-circle me-2"></i><strong>¡Éxito!</strong> ' + response.message
                        );
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        
                        // Extraer mensaje de error
                        let errorMessage = 'Error al enviar el correo';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        
                        // Actualizar UI
                        $('#mail-status').removeClass('bg-secondary').addClass('bg-danger').text('Error');
                        
                        // Mostrar error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al enviar correo',
                            html: errorMessage
                        });
                        
                        // Mostrar resultado
                        $('#result-container').removeClass('d-none alert-success').addClass('alert alert-danger').html(
                            '<i class="mdi mdi-alert-circle me-2"></i><strong>Error:</strong> ' + errorMessage
                        );
                    }
                });
            });
        });
    </script>
</body>
</html> 