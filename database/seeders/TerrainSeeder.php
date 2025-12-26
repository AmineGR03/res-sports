<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TerrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si les terrains existent déjà
        if (\App\Models\Terrain::count() > 0) {
            echo "Terrains already seeded, skipping...\n";
            return;
        }

        $terrains = [
            [
                'nom' => 'Terrain de Football Central',
                'type' => 'football',
                'prix_heure' => 25.00,
                'description' => 'Terrain de football en gazon synthétique de qualité professionnelle',
            ],
            [
                'nom' => 'Terrain de Basketball A',
                'type' => 'basketball',
                'prix_heure' => 20.00,
                'description' => 'Terrain de basketball avec paniers réglementaires',
            ],
            [
                'nom' => 'Court de Tennis 1',
                'type' => 'tennis',
                'prix_heure' => 15.00,
                'description' => 'Court de tennis en terre battue',
            ],
            [
                'nom' => 'Terrain de Volleyball',
                'type' => 'volleyball',
                'prix_heure' => 18.00,
                'description' => 'Terrain de volleyball de sable',
            ],
            [
                'nom' => 'Terrain de Handball',
                'type' => 'handball',
                'prix_heure' => 22.00,
                'description' => 'Terrain de handball intérieur climatisé',
            ],
        ];

        foreach ($terrains as $terrain) {
            \App\Models\Terrain::create($terrain);
        }

        echo "Created " . count($terrains) . " terrains.\n";
    }
}
