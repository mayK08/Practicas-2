<!DOCTYPE html>
<html lang="es" style="background-color: #f2f2f2; position: relative; height: 100%">
<head>
    <meta charset="utf-8" />
    <title>Confirmación de Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="keywords" content="" />
    <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" type="image/vnd.microsoft.icon" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <link href="{{ asset('css/vendor.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <!-- ================== END BASE CSS STYLE ================== -->
</head>

<div style="background-color: #f2f2f2; position: relative; height: 100%">
    <div style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #000; width: 75%; max-width: 680px; min-width: 320px; margin: 80px auto; background-color: #ffffff; border-radius: 24px; box-shadow: 0 0 2rem rgba(0,0,0,0.1); min-height: 500px;">
        <div style="padding: 32px; background-color: #960E53; color:black; border-bottom: 1px solid #ddd; text-align: center;">
            <img style="height: 96px; margin-bottom: 0" src="{{ asset('images/logo-escudo.svg') }}" alt="Gobierno del Estado de Sonora">
        </div>

        <div style="padding:64px; min-height: 300px;">
            <h1 style="font-size: 32px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-weight: bold; color:#410123; margin: 16px auto; text-align: center">
                ¡Registro Exitoso!
            </h1>
            <!-- <h2 style="font-size: 28px; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-weight: bold; color:#960E53; margin: 16px auto; text-align: center">
                Declaranet Sonora
            </h2> -->
            
            <p style="text-align: center; font-size: 16px; line-height: 1.4; color: #333;">
                Hemos recibido tu solicitud de registro con los siguientes datos:
            </p>
            
            <div style="margin: 32px 0; padding: 20px; background-color: #f8f9fa; border-radius: 8px;">
                <p style="margin: 8px 0;"><strong>Nombre Completo:</strong> {{ $empleado->nombre }} {{ $empleado->apellido_paterno }} {{ $empleado->apellido_materno }}</p>
                <p style="margin: 8px 0;"><strong>CURP:</strong> {{ $empleado->curp }}</p>
                <p style="margin: 8px 0;"><strong>Número de Empleado:</strong> {{ $empleado->num_empleado }}</p>
                <p style="margin: 8px 0;"><strong>Puesto:</strong> {{ $empleado->puesto }}</p>
                <p style="margin: 8px 0;"><strong>Dependencia:</strong> {{ $empleado->dependencia }}</p>
                <p style="margin: 8px 0;"><strong>Correo Electrónico:</strong> {{ $empleado->email }}</p>
            </div>

            <p style="font-size: 16px; line-height: 1.4; color: #333;">
                Tu solicitud ha sido recibida y está siendo procesada. Te notificaremos por correo electrónico cuando tu registro sea aprobado.
            </p>

            <p style="font-weight: 600; margin-top: 32px;">
                Atte. <br>
                Gobierno del Estado de Sonora <br>
            </p>
        </div>

        <div style="padding: 32px; border-top: 1px solid #ddd; text-align: center; color:#ffffff; background-color: #410123;">
            <a href="https://www.sonora.gob.mx">
                <img style="height: 70px; margin-bottom: 16px;" src="{{ asset('images/logo-sonora-white.svg') }}" alt="Sonora: Tierra de Oportunidades">
            </a>
            
            <p style="margin: 16px auto; font-size: 12px;">
                <a style="margin: 0 8px; color:#ffffff;" href="https://www.sonora.gob.mx/gobierno/politicas-de-uso-y-privacidad" title="Política de Uso y Privacidad">Política de Uso y Privacidad</a>
                <a style="margin: 0 8px; color:#ffffff;" href="https://denunciapp.sonora.gob.mx/" title="Denuncia Ciudadana" target="_blank" rel="nofollow noreferrer noopener">Denuncia Ciudadana</a>
                <a style="margin: 0 8px; color:#ffffff;" href="https://www.sonora.gob.mx/contacto" title="Contacto" target="_blank" rel="nofollow noreferrer noopener">Contacto</a>
            </p>

            <p style="font-size: 12px; color:#ffffff;">
                {{ date('Y') }}. Gobierno del Estado de Sonora. Todos los derechos reservados
            </p>
        </div>
    </div>
</div>
</html> 