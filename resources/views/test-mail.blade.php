<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de Correo - Declaranet Sonora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .card-header {
            background: linear-gradient(135deg, #1976D2, #1565C0);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            text-align: center;
        }
        .btn-primary {
            background: linear-gradient(135deg, #1976D2, #1565C0);
            border: none;
            border-radius: 25px;
            padding: 10px 30px;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #1565C0, #0D47A1);
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-envelope me-2"></i>
                            Prueba de Configuración de Correo
                        </h3>
                        <p class="mb-0">Declaranet Sonora</p>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success">
                                <h5><i class="fas fa-check-circle me-2"></i>¡Éxito!</h5>
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i>Error</h5>
                                <p class="mb-0">{{ session('error') }}</p>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-cog me-2"></i>Configuración Actual
                                </h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Mailer:</span>
                                        <span class="badge bg-info">{{ config('mail.default') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Host:</span>
                                        <span class="text-muted">{{ config('mail.mailers.smtp.host') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Puerto:</span>
                                        <span class="text-muted">{{ config('mail.mailers.smtp.port') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Encriptación:</span>
                                        <span class="text-muted">{{ config('mail.mailers.smtp.encryption') ?: 'Ninguna' }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Usuario:</span>
                                        <span class="text-muted">{{ config('mail.mailers.smtp.username') ?: 'No configurado' }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Desde:</span>
                                        <span class="text-muted">{{ config('mail.from.address') }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-paper-plane me-2"></i>Probar Envío
                                </h5>
                                <form action="{{ route('test.mail') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo de prueba:</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               placeholder="tu@email.com" required>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-send me-2"></i>Enviar Correo de Prueba
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Instrucciones para configurar correo:</h6>
                            <ol class="mb-0">
                                <li>Edita el archivo <code>.env</code> con la configuración de tu servidor SMTP</li>
                                <li>Si usas Gmail, crea una "Contraseña de aplicación" en tu cuenta Google</li>
                                <li>Para pruebas, puedes usar <a href="https://mailtrap.io" target="_blank">Mailtrap</a></li>
                                <li>Ejecuta <code>php artisan config:cache</code> después de cambiar la configuración</li>
                                <li>Usa el comando <code>php artisan mail:test</code> para probar desde consola</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
</body>
</html> 