<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            // Eliminar la restricción UNIQUE si existe (en PG la restricción posee el índice)
            DB::statement('ALTER TABLE usuarios DROP CONSTRAINT IF EXISTS usuarios_curp_unique;');

            // Hacer curp nullable
            Schema::table('usuarios', function (Blueprint $table) {
                $table->string('curp', 18)->nullable()->change();
            });

            // Crear índice único parcial para curp no nulo
            DB::statement('CREATE UNIQUE INDEX IF NOT EXISTS usuarios_curp_unique ON usuarios(curp) WHERE curp IS NOT NULL;');
        } else {
            // MySQL: permitir múltiples NULL con UNIQUE estándar
            Schema::table('usuarios', function (Blueprint $table) {
                $table->string('curp', 18)->nullable()->change();
            });
        }
    }

    public function down()
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            // Eliminar índice parcial
            DB::statement('DROP INDEX IF EXISTS usuarios_curp_unique;');

            Schema::table('usuarios', function (Blueprint $table) {
                $table->string('curp', 18)->nullable(false)->change();
            });

            // Restaurar restricción UNIQUE normal
            DB::statement('ALTER TABLE usuarios ADD CONSTRAINT usuarios_curp_unique UNIQUE (curp);');
        } else {
            Schema::table('usuarios', function (Blueprint $table) {
                $table->string('curp', 18)->nullable(false)->change();
            });
        }
    }
};


