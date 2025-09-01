<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;

class ListUsers extends Command
{
    protected $signature = 'users:list';

    protected $description = 'List all users in the database';

    public function handle()
    {
        $users = Usuario::all(['curp', 'username', 'email', 'rol']);
        
        if ($users->isEmpty()) {
            $this->info('No users found in the database.');
            return 0;
        }
        
        $this->info('Users in the database:');
        $this->table(['CURP', 'Username', 'Email', 'Role'], $users->toArray());
        
        return 0;
    }
}
