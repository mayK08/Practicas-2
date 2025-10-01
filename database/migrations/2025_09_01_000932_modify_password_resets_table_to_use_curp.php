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
        Schema::table('password_resets', function (Blueprint $table) {
            // Add curp column if it doesn't exist
            if (!Schema::hasColumn('password_resets', 'curp')) {
                $table->string('curp')->index();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            // Drop curp column if it exists
            if (Schema::hasColumn('password_resets', 'curp')) {
                $table->dropIndex(['curp']);
                $table->dropColumn('curp');
            }
        });
    }
};
