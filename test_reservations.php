<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TEST DU SYSTÈME DE RÉSERVATIONS ===\n\n";

// Test 1: Connexion utilisateur
$clientUser = \App\Models\User::where('role', 'client')->first();
if (!$clientUser) {
    echo "❌ Aucun utilisateur client trouvé!\n";
    exit(1);
}

\Auth::login($clientUser);
echo "✅ Utilisateur connecté: {$clientUser->name}\n\n";

// Test 2: Récupération des données
$terrain = \App\Models\Terrain::first();
$equipements = \App\Models\Equipement::where('quantite', '>', 0)->get();

if (!$terrain) {
    echo "❌ Aucun terrain trouvé!\n";
    exit(1);
}

echo "✅ Terrain trouvé: {$terrain->nom} (Prix: {$terrain->prix_heure}€/h)\n";
echo "✅ Équipements disponibles: {$equipements->count()}\n\n";

// Test 3: Test de création de réservation
echo "3. Test de création de réservation...\n";

$reservationController = new \App\Http\Controllers\ReservationController();

// Test de la vue create
try {
    $request = new \Illuminate\Http\Request([
        'terrain_id' => $terrain->id,
        'date' => now()->addDays(1)->format('Y-m-d'),
        'heure_debut' => '14:00'
    ]);

    $response = $reservationController->create($request);
    echo "✅ Vue de création accessible\n";
} catch (Exception $e) {
    echo "❌ Erreur vue création: " . $e->getMessage() . "\n";
}

// Test de la création de réservation
try {
    $testEquipements = [];
    if ($equipements->count() > 0) {
        $firstEquipement = $equipements->first();
        echo "🔧 Équipement test: {$firstEquipement->nom} - Prix: {$firstEquipement->prix_location}€\n";
        $testEquipements = [
            [
                'id' => $firstEquipement->id,
                'quantite' => 1
            ]
        ];
    }

    $request = new \Illuminate\Http\Request([
        'terrain_id' => $terrain->id,
        'date' => now()->addDays(1)->format('Y-m-d'),
        'heure_debut' => '15:00',
        'duree' => 2,
        'equipements' => $testEquipements,
        'notes' => 'Test reservation'
    ]);

    // Debug: Check what data is being sent
    echo "📤 Données envoyées: terrain_id={$request->terrain_id}, duree={$request->duree}, equipements=" . json_encode($request->equipements) . "\n";

    $response = $reservationController->store($request);

    if ($response) {
        echo "✅ Réservation créée avec succès\n";

        // Vérifier que la réservation a été créée
        $reservationsCount = \App\Models\Reservation::count();
        $lastReservation = \App\Models\Reservation::latest()->first();

        echo "📊 Total réservations: $reservationsCount\n";
        echo "📅 Dernière réservation: {$lastReservation->date} à {$lastReservation->heure_debut}\n";
        echo "💰 Total calculé: {$lastReservation->total}€\n";

        // Calcul du total attendu
        $expectedTotal = $terrain->prix_heure * 2; // 2 heures
        if ($testEquipements) {
            $equipement = \App\Models\Equipement::find($testEquipements[0]['id']);
            if ($equipement) {
                $expectedTotal += ($equipement->prix_location ?? 0) * $testEquipements[0]['quantite'];
            }
        }

        if (abs($lastReservation->total - $expectedTotal) < 0.01) {
            echo "✅ Total correctement calculé: {$expectedTotal}€\n";
        } else {
            echo "❌ Erreur de calcul du total: attendu {$expectedTotal}€, obtenu {$lastReservation->total}€\n";
        }
    }

} catch (Exception $e) {
    echo "❌ Erreur création réservation: " . $e->getMessage() . "\n";
}

echo "\n=== RÉSULTATS DU TEST ===\n";

$finalStats = [
    'Utilisateurs' => \App\Models\User::count(),
    'Terrains' => \App\Models\Terrain::count(),
    'Équipements' => \App\Models\Equipement::count(),
    'Réservations' => \App\Models\Reservation::count(),
];

foreach ($finalStats as $label => $count) {
    echo "✅ $label: $count\n";
}

echo "\n🎯 Test terminé - Vérifiez les résultats ci-dessus!\n";
