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
        // Esta migración marca la tabla usuarios como ya migrada
        // La tabla ya existe en la base de datos, por lo que no necesitamos crearla
        if (!Schema::hasTable('usuarios')) {
            Schema::create('usuarios', function (Blueprint $table) {
                $table->id();
                $table->string('curp')->unique();
                $table->string('username')->unique();
                $table->string('password_hash');
                $table->enum('rol', ['SuperAdmin', 'admin', 'capturador'])->default('capturador');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
