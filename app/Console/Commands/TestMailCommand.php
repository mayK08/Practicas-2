<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Empleado;
use App\Notifications\SolicitudAprobada;
use App\Notifications\SolicitudRechazada;

class TestMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Probar el envío de correos electrónicos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        if (!$email) {
            $email = $this->ask('Ingresa el correo electrónico para la prueba:');
        }
        
        $this->info("Probando envío de correo a: {$email}");
        
        try {
            // Buscar un empleado existente con ese email
            $empleado = Empleado::where('email', $email)->first();
            
            if (!$empleado) {
                $this->error("❌ No se encontró ningún empleado con el email: {$email}");
                $this->info("Empleados disponibles:");
                $empleados = Empleado::select('curp', 'nombre', 'apellido_paterno', 'email')->get();
                foreach ($empleados as $emp) {
                    $this->line("- {$emp->email} ({$emp->nombre} {$emp->apellido_paterno})");
                }
                return 1;
            }
            
            $this->info("Empleado encontrado: {$empleado->nombre} {$empleado->apellido_paterno}");
            
            // Probar notificación de aprobación
            $this->info('Enviando notificación de aprobación...');
            $empleado->notify(new SolicitudAprobada($empleado));
            $this->info('✅ Notificación de aprobación enviada correctamente');
            
            // Probar notificación de rechazo
            $this->info('Enviando notificación de rechazo...');
            $empleado->motivo_rechazo = 'Documentación incompleta';
            $empleado->notify(new SolicitudRechazada($empleado));
            $this->info('✅ Notificación de rechazo enviada correctamente');
            
            $this->info('🎉 Todas las pruebas de correo fueron exitosas!');
            
        } catch (\Exception $e) {
            $this->error('❌ Error al enviar correo: ' . $e->getMessage());
            $this->error('Detalles del error: ' . $e->getTraceAsString());
            return 1;
        }
        
        return 0;
    }
}
