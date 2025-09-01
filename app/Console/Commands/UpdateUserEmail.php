<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;

class UpdateUserEmail extends Command
{
    protected $signature = 'user:update-email {curp} {email}';

    protected $description = 'Actualizar email de un usuario existente';

    public function handle()
    {
        $curp = $this->argument('curp');
        $email = $this->argument('email');
        
        $user = Usuario::where('curp', $curp)->first();
        
        if (!$user) {
            $this->error("Usuario con CURP {$curp} no encontrado.");
            return 1;
        }
        
        $user->email = $email;
        $user->save();
        
        $this->info("Email actualizado para {$user->username}: {$email}");
        
        return 0;
    }
}
