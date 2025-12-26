<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un administrateur seulement s'il n'existe pas
        if (!\App\Models\User::where('email', 'admin@res-sports.com')->exists()) {
            \App\Models\User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@res-sports.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'telephone' => '0123456789',
            ]);
        }

        // Créer quelques clients de test seulement s'il n'y en a pas
        if (\App\Models\User::where('role', 'client')->count() == 0) {
            \App\Models\User::factory(5)->create([
                'role' => 'client',
            ]);
        }

        // Appeler les seeders
        $this->call([
            TerrainSeeder::class,
            EquipementSeeder::class,
        ]);
    }
}
