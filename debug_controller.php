<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Login as client
$clientUser = \App\Models\User::where('role', 'client')->first();
\Auth::login($clientUser);

// Get test data
$terrain = \App\Models\Terrain::first();
$equipements = \App\Models\Equipement::where('quantite', '>', 0)->get();

echo "=== DEBUG CONTROLLER DIRECTLY ===\n\n";

// Simulate the request data
$requestData = [
    'terrain_id' => $terrain->id,
    'date' => now()->addDays(1)->format('Y-m-d'),
    'heure_debut' => '16:00',
    'duree' => 2,
    'equipements' => [
        [
            'id' => $equipements->first()->id,
            'quantite' => 1
        ]
    ],
    'notes' => 'Debug test'
];

$request = new \Illuminate\Http\Request($requestData);

echo "Request data:\n";
print_r($requestData);
echo "\n";

// Manually test the filtering logic
$filteredEquipements = [];
if ($request->equipements) {
    foreach ($request->equipements as $equipementData) {
        if (isset($equipementData['quantite']) && $equipementData['quantite'] > 0) {
            $filteredEquipements[] = $equipementData;
        }
    }
}

echo "Filtered equipment:\n";
print_r($filteredEquipements);
echo "\n";

// Test total calculation
$total = $terrain->prix_heure * $request->duree;
echo "Base total (terrain): {$terrain->prix_heure} * {$request->duree} = $total\n";

foreach ($filteredEquipements as $equipementData) {
    $equipement = \App\Models\Equipement::find($equipementData['id']);
    if ($equipement) {
        $equipmentCost = ($equipement->prix_location ?? 0) * $equipementData['quantite'];
        $total += $equipmentCost;
        echo "Equipment cost: {$equipement->nom} - ({$equipement->prix_location} * {$equipementData['quantite']}) = $equipmentCost\n";
    }
}

echo "Final total: $total\n";
