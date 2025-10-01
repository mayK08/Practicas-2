<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestPasswordReset extends Command
{
    protected $signature = 'test:password-reset {email}';

    protected $description = 'Probar el envío de enlace de restablecimiento por email';

    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info("Probando restablecimiento para: {$email}");
        
        // Buscar empleado por email
        $empleado = Empleado::where('email', $email)->first();
        
        if (!$empleado) {
            $this->error("No existe empleado con ese correo.");
            return 1;
        }
        
        $this->info("Empleado encontrado: {$empleado->nombre} {$empleado->apellido_paterno}");
        
        // Buscar usuario con el CURP del empleado
        $usuario = Usuario::where('curp', $empleado->curp)->first();
        
        if (!$usuario) {
            $this->error("No existe usuario con CURP: {$empleado->curp}");
            return 1;
        }
        
        $this->info("Usuario encontrado: {$usuario->username}");
        
        // Eliminar tokens anteriores para este email
        DB::table('password_resets')->where('email', $empleado->email)->delete();
        
        // Crear token manualmente usando el email del empleado
        $token = Str::random(60);
        
        // Insertar directamente en password_resets con el email del empleado
        DB::table('password_resets')->insert([
            'email' => $empleado->email,
            'token' => bcrypt($token),
            'created_at' => now(),
        ]);
        
        // Enviar notificación usando el email del empleado
        $usuario->sendPasswordResetNotification($token);
        
        $this->info('¡Enlace enviado exitosamente!');
        $this->info('Mensaje: ' . trans('passwords.sent'));
        
        return 0;
    }
}
