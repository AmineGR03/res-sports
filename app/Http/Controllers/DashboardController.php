<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Terrain;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirect admin users to admin dashboard
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if (auth()->check()) {
            // Pour les utilisateurs connectés (clients uniquement)
            $stats = [
                'total_users' => User::count(),
                'total_terrains' => Terrain::count(),
                'total_reservations' => Reservation::count(),
                'active_reservations' => Reservation::whereIn('statut', ['en_attente', 'confirmee'])->count(),
            ];

            $recent_reservations = Reservation::with(['user', 'terrain'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            $popular_terrains = Terrain::withCount('reservations')
                ->orderBy('reservations_count', 'desc')
                ->take(5)
                ->get();

            return view('dashboard.index', compact('stats', 'recent_reservations', 'popular_terrains'));
        } else {
            // Pour les utilisateurs non connectés
            $stats = [
                'total_terrains' => Terrain::count(),
            ];

            $popular_terrains = Terrain::withCount('reservations')
                ->orderBy('reservations_count', 'desc')
                ->take(5)
                ->get();

            return view('dashboard.index', compact('stats', 'popular_terrains'));
        }
    }
}
