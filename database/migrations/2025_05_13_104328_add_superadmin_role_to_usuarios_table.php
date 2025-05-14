<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Verificar que la tabla exista
        if (Schema::hasTable('usuarios')) {
            // Crear un usuario SuperAdmin de ejemplo
            DB::table('usuarios')->insert([
                'curp' => 'SUPERADMIN000000XXXXX',
                'username' => 'superadmin',
                'password_hash' => Hash::make('superadmin123'),
                'rol' => 'SuperAdmin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('usuarios')) {
            // Eliminar el usuario SuperAdmin creado
            DB::table('usuarios')
                ->where('curp', 'SADM850101HDFPRN09')
                ->delete();
        }
    }
};
