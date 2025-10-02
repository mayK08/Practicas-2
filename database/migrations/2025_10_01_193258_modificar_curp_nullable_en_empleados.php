<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. Eliminar la restricción UNIQUE de la columna curp
        DB::statement('ALTER TABLE empleados DROP CONSTRAINT IF EXISTS empleados_curp_unique;');

        // 2. Hacer la columna nullable
        Schema::table('empleados', function (Blueprint $table) {
            $table->string('curp', 18)->nullable()->change();
        });

        // 3. Crear un índice único parcial (solo aplica si curp no es NULL)
        DB::statement('CREATE UNIQUE INDEX empleados_curp_unique ON empleados(curp) WHERE curp IS NOT NULL;');
    }

    public function down()
    {
        // 1. Borrar el índice parcial
        DB::statement('DROP INDEX IF EXISTS empleados_curp_unique;');

        // 2. Volver a hacer la columna obligatoria
        Schema::table('empleados', function (Blueprint $table) {
            $table->string('curp', 18)->nullable(false)->change();
        });

        // 3. Volver a crear la restricción UNIQUE normal
        DB::statement('ALTER TABLE empleados ADD CONSTRAINT empleados_curp_unique UNIQUE (curp);');
    }
};
