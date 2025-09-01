<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Empleado;

class ListEmpleados extends Command
{
    protected $signature = 'empleados:list';

    protected $description = 'List all empleados in the database';

    public function handle()
    {
        $empleados = Empleado::all(['curp', 'nombre', 'apellido_paterno', 'email']);
        
        if ($empleados->isEmpty()) {
            $this->info('No empleados found in the database.');
            return 0;
        }
        
        $this->info('Empleados in the database:');
        $this->table(['CURP', 'Nombre', 'Apellido', 'Email'], $empleados->toArray());
        
        return 0;
    }
}
