<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id(); // id autoincremental como PK
            $table->string('curp', 18)->unique(); // curp como único, ya no PK
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50);
            $table->string('nombre', 100);
            $table->integer('anio_ingreso');
            $table->string('num_expediente', 50);
            $table->string('num_empleado', 50);
            $table->string('status', 20);
            $table->string('solicitud_status')->default('Pendiente')->after('status');
            $table->text('motivo_rechazo')->nullable()->after('solicitud_status');
            $table->string('puesto', 100);
            $table->string('adscripcion', 100);
            $table->string('dependencia', 100);
            $table->string('ciudad', 100);
            $table->string('email');
            $table->string('telefono', 20);
            $table->binary('datos_biometricos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
