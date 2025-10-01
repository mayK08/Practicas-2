# Configuración de Correo Electrónico - Declaranet Sonora

## 📧 Configuración del Archivo .env

Para que el envío de correos funcione correctamente, debes editar el archivo `.env` con la configuración de tu servidor SMTP.

### Opción 1: Gmail (Recomendado para desarrollo)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu.correo@gmail.com
MAIL_PASSWORD=tu-contraseña-de-aplicacion
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="declaranet@sonora.gob.mx"
MAIL_FROM_NAME="Declaranet Sonora"
```

**⚠️ Importante para Gmail:**
1. Ve a tu cuenta Google → Seguridad
2. Activa la verificación en dos pasos si no la tienes
3. Ve a "Contraseñas de aplicaciones"
4. Crea una nueva contraseña para tu aplicación Laravel
5. Usa esa contraseña generada en `MAIL_PASSWORD`

### Opción 2: Mailtrap (Para pruebas)

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=tu-usuario-mailtrap
MAIL_PASSWORD=tu-contraseña-mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="declaranet@sonora.gob.mx"
MAIL_FROM_NAME="Declaranet Sonora"
```

Regístrate en [mailtrap.io](https://mailtrap.io) para obtener credenciales gratuitas.

### Opción 3: Servidor SMTP propio

```env
MAIL_MAILER=smtp
MAIL_HOST=tu-servidor-smtp.com
MAIL_PORT=587
MAIL_USERNAME=tu-usuario
MAIL_PASSWORD=tu-contraseña
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="declaranet@sonora.gob.mx"
MAIL_FROM_NAME="Declaranet Sonora"
```

## 🔧 Pasos para Configurar

1. **Edita el archivo `.env`** con la configuración de tu servidor SMTP
2. **Limpia la caché de configuración:**
   ```bash
   php artisan config:clear
   php artisan config:cache
   ```
3. **Prueba el envío de correos:**
   - Desde la web: Ve a `/test-mail`
   - Desde consola: `php artisan mail:test tu@email.com`

## 🧪 Probar el Sistema

### Opción 1: Interfaz Web
1. Ve a `http://tu-dominio.com/test-mail`
2. Ingresa tu correo electrónico
3. Haz clic en "Enviar Correo de Prueba"
4. Verifica tu bandeja de entrada y carpeta de spam

### Opción 2: Comando de Consola
```bash
php artisan mail:test tu@email.com
```

## 📋 Verificación

Si todo está configurado correctamente, deberías:

1. ✅ Recibir un correo de prueba
2. ✅ Ver mensajes de éxito en la interfaz
3. ✅ No ver errores en los logs

## 🚨 Solución de Problemas

### Error: "Connection refused"
- Verifica que el puerto no esté bloqueado por el firewall
- Confirma que las credenciales sean correctas

### Error: "Authentication failed"
- Para Gmail: Usa una contraseña de aplicación, no tu contraseña normal
- Verifica que el usuario y contraseña sean correctos

### Error: "SSL certificate problem"
- Cambia `MAIL_ENCRYPTION=tls` a `MAIL_ENCRYPTION=ssl`
- O agrega `MAIL_VERIFY_PEER=false` (solo para desarrollo)

### No recibes correos
- Revisa la carpeta de spam
- Verifica que el correo esté bien escrito
- Confirma que el servidor SMTP esté funcionando

## 📧 Notificaciones Implementadas

El sistema incluye las siguientes notificaciones:

1. **SolicitudAprobada**: Se envía cuando se aprueba una solicitud de registro
2. **SolicitudRechazada**: Se envía cuando se rechaza una solicitud de registro

## 🔄 Configuración de Colas (Opcional)

Para mejor rendimiento, puedes usar colas:

```env
QUEUE_CONNECTION=database
```

Luego ejecuta:
```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

## 📝 Logs

Los errores de correo se registran en:
- `storage/logs/laravel.log`
- Consola del navegador (F12)

## 🆘 Soporte

Si tienes problemas:
1. Revisa los logs de Laravel
2. Verifica la configuración SMTP
3. Prueba con Mailtrap primero
4. Confirma que el servidor tenga acceso a internet

