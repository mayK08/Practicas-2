<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'curp',
        'username',
        'email',
        'password_hash',
        'rol',
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /**
     * Relación con el empleado
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'curp', 'curp');
    }

    /**
     * Email para restablecer contraseña - obtiene el email del empleado relacionado
     */
    public function getEmailForPasswordReset()
    {
        // Primero intenta usar el email directo del usuario
        if ($this->email) {
            return $this->email;
        }
        
        // Si no tiene email directo, busca en la tabla empleados
        $empleado = $this->empleado;
        if ($empleado && $empleado->email) {
            return $empleado->email;
        }
        
        return null;
    }

    /**
     * Ruta para enviar notificaciones por correo
     */
    public function routeNotificationForMail()
    {
        return $this->getEmailForPasswordReset();
    }

    /**
     * Enviar notificación de restablecimiento
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
} 