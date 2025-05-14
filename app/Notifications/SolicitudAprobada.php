<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Empleado;

class SolicitudAprobada extends Notification implements ShouldQueue
{
    use Queueable;

    protected $empleado;

    /**
     * Create a new notification instance.
     *
     * @param Empleado $empleado
     * @return void
     */
    public function __construct(Empleado $empleado)
    {
        $this->empleado = $empleado;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Solicitud de Registro Aprobada - Declaranet Sonora')
            ->greeting('¡Hola ' . $this->empleado->nombre . ' ' . $this->empleado->apellido_paterno . '!')
            ->line('Nos complace informarte que tu solicitud de registro en el sistema Declaranet Sonora ha sido aprobada.')
            ->line('Ya puedes iniciar sesión en el sistema utilizando tu CURP y la contraseña que estableciste durante el registro.')
            ->action('Iniciar sesión', url('/'))
            ->line('Recuerda que es obligatorio presentar tu declaración patrimonial en los plazos establecidos por la ley.')
            ->line('Si tienes alguna duda o necesitas asistencia, no dudes en contactarnos.')
            ->salutation('Atentamente, el equipo de Declaranet Sonora');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'empleado_curp' => $this->empleado->curp,
            'empleado_nombre' => $this->empleado->nombre,
            'empleado_apellido_paterno' => $this->empleado->apellido_paterno,
            'empleado_apellido_materno' => $this->empleado->apellido_materno,
            'solicitud_status' => $this->empleado->solicitud_status,
            'fecha_aprobacion' => now()->format('Y-m-d H:i:s'),
        ];
    }
} 