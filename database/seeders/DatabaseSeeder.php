<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\Usuario::create([
        //     'curp' => 'REVJ030616HCSYZHA8',
        //     'username' => 'Jhonatan Reyes',
        //     'password_hash' => bcrypt('12345678'),
        //     'rol' => 'capturador',
        // ]);

        // \App\Models\Usuario::create([
        //     'curp' => 'MAPP250508HASRRDA7',
        //     'username' => 'Pedro Perez',
        //     'password_hash' => bcrypt('12345678'),
        //     'rol' => 'admin',
        // ]);

        \App\Models\Usuario::create([
            'curp' => 'SADM850101HDFPRN09',
            'username' => 'SuperAdmin',
            'password_hash' => bcrypt('superadmin123'),
            'rol' => 'SuperAdmin',
        ]);
    }
}
