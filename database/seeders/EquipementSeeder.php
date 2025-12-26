<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si les équipements existent déjà
        if (\App\Models\Equipement::count() > 0) {
            echo "Equipements already seeded, skipping...\n";
            return;
        }

        $equipements = [
            [
                'nom' => 'Ballon de Football',
                'quantite' => 10,
                'prix_location' => 5.00,
                'description' => 'Ballon de football taille 5 professionnel',
            ],
            [
                'nom' => 'Ballon de Basketball',
                'quantite' => 8,
                'prix_location' => 4.00,
                'description' => 'Ballon de basketball taille 7',
            ],
            [
                'nom' => 'Raquette de Tennis',
                'quantite' => 12,
                'prix_location' => 6.00,
                'description' => 'Raquette de tennis adulte avec cordage',
            ],
            [
                'nom' => 'Ballon de Volleyball',
                'quantite' => 6,
                'prix_location' => 3.00,
                'description' => 'Ballon de volleyball professionnel',
            ],
            [
                'nom' => 'Ballon de Handball',
                'quantite' => 8,
                'prix_location' => 4.00,
                'description' => 'Ballon de handball taille 3',
            ],
            [
                'nom' => 'Maillot de Sport',
                'quantite' => 20,
                'prix_location' => 2.00,
                'description' => 'Maillot de sport respirant',
            ],
            [
                'nom' => 'Gourde d\'eau',
                'quantite' => 30,
                'prix_location' => 1.00,
                'description' => 'Gourde d\'eau réutilisable',
            ],
        ];

        foreach ($equipements as $equipement) {
            \App\Models\Equipement::create($equipement);
        }

        echo "Created " . count($equipements) . " equipements.\n";
    }
}
