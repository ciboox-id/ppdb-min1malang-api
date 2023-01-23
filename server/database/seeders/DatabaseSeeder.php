<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
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
        // User::factory(50)->create();

        \App\Models\User::factory()->create([
            'nama_lengkap' => 'Admin PPDB MIN 1 Malang',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('ppdbmin1malang'),
            'role' => 'admin'
        ]);

        // \App\Models\User::factory()->create([
        //     'nama_lengkap' => 'Andre Kurniawan',
        //     'email' => 'andre_kun@gmail.com',
        //     'password' => bcrypt('rahasia'),
        // ]);
    }
}
