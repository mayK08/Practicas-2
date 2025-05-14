<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Empleado;

class SolicitudRechazada extends Notification implements ShouldQueue
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
        $message = (new MailMessage)
            ->subject('Solicitud de Registro Rechazada - Declaranet Sonora')
            ->greeting('Hola ' . $this->empleado->nombre . ' ' . $this->empleado->apellido_paterno)
            ->line('Lamentamos informarte que tu solicitud de registro en el sistema Declaranet Sonora ha sido rechazada.');
            
        // Agregar el motivo de rechazo si existe
        if (!empty($this->empleado->motivo_rechazo)) {
            $message->line('Motivo del rechazo: ' . $this->empleado->motivo_rechazo);
        }
        
        return $message->line('Te recomendamos revisar la información proporcionada y enviar una nueva solicitud.')
            ->line('Si consideras que ha habido un error o necesitas más información, por favor comunícate con el departamento de sistemas.')
            ->action('Intentar nuevamente', url('/empleados/registro'))
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
            'motivo_rechazo' => $this->empleado->motivo_rechazo,
            'fecha_rechazo' => now()->format('Y-m-d H:i:s'),
        ];
    }
} 