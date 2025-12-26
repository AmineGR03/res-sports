<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TerrainController extends Controller
{
    public function index()
    {
        $terrains = Terrain::all();
        return view('terrains.index', compact('terrains'));
    }

    public function show(Terrain $terrain, Request $request)
    {
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));

        $reservations = Reservation::where('terrain_id', $terrain->id)
            ->where('date', $date)
            ->whereIn('statut', ['en_attente', 'confirmee'])
            ->get();

        $creneaux = $this->genererCreneauxDisponibles($reservations);

        return view('terrains.show', compact('terrain', 'creneaux', 'date'));
    }

    private function genererCreneauxDisponibles($reservations)
    {
        $creneaux = [];
        $heureDebut = 8;
        $heureFin = 22;

        for ($heure = $heureDebut; $heure < $heureFin; $heure++) {
            for ($minute = 0; $minute < 60; $minute += 30) {
                $heureDebutCreneau = sprintf('%02d:%02d', $heure, $minute);
                $heureFinCreneau = date('H:i', strtotime($heureDebutCreneau) + 3600);

                $disponible = true;

                foreach ($reservations as $reservation) {
                    if ($this->chevauchementCreneau($heureDebutCreneau, $heureFinCreneau, $reservation->heure_debut, $reservation->getHeureFinAttribute())) {
                        $disponible = false;
                        break;
                    }
                }

                $creneaux[] = [
                    'heure_debut' => $heureDebutCreneau,
                    'heure_fin' => $heureFinCreneau,
                    'disponible' => $disponible,
                ];
            }
        }

        return $creneaux;
    }

    private function chevauchementCreneau($debut1, $fin1, $debut2, $fin2)
    {
        $timestampDebut1 = strtotime($debut1);
        $timestampFin1 = strtotime($fin1);
        $timestampDebut2 = strtotime($debut2);
        $timestampFin2 = strtotime($fin2);

        return $timestampDebut1 < $timestampFin2 && $timestampFin1 > $timestampDebut2;
    }
}
