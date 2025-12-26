<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Terrain;
use App\Models\Equipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    // Dashboard simple
    public function dashboard()
    {
        $stats = [
            'total_reservations' => Reservation::count(),
            'pending_reservations' => Reservation::where('statut', 'en_attente')->count(),
            'confirmed_reservations' => Reservation::where('statut', 'confirmee')->count(),
            'cancelled_reservations' => Reservation::where('statut', 'annulee')->count(),
            'total_users' => User::count(),
            'total_terrains' => Terrain::count(),
            'total_equipements' => Equipement::count(),
        ];

        $recentReservations = Reservation::with(['user', 'terrain'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentReservations'));
    }

    // Gestion des réservations
    public function reservations(Request $request)
    {
        $query = Reservation::with(['user', 'terrain', 'equipements']);

        // Filtrage par statut
        if ($request->has('status') && in_array($request->status, ['en_attente', 'confirmee', 'annulee', 'terminee'])) {
            $query->where('statut', $request->status);
        }

        // Recherche
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', '%' . $search . '%')
                             ->orWhere('email', 'like', '%' . $search . '%');
                })
                ->orWhereHas('terrain', function($terrainQuery) use ($search) {
                    $terrainQuery->where('nom', 'like', '%' . $search . '%');
                });
            });
        }

        $reservations = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.reservations', compact('reservations'));
    }

    // Voir une réservation
    public function showReservation(Reservation $reservation)
    {
        $reservation->load(['user', 'terrain', 'equipements']);
        return view('admin.reservation-detail', compact('reservation'));
    }

    // Changer le statut d'une réservation
    public function updateReservationStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,confirmee,annulee,terminee',
        ]);

        $reservation->update(['statut' => $request->statut]);

        return redirect()->back()->with('success', 'Statut de la réservation mis à jour avec succès.');
    }

    // Gestion des utilisateurs
    public function users()
    {
        $users = User::paginate(15);
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users-create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,client',
            'telephone' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès.');
    }

    public function editUser(User $user)
    {
        return view('admin.users-edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,client',
            'telephone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès.');
    }

    // Gestion des terrains
    public function terrains()
    {
        $terrains = Terrain::paginate(15);
        return view('admin.terrains', compact('terrains'));
    }

    public function createTerrain()
    {
        return view('admin.terrains-create');
    }

    public function storeTerrain(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:football,basketball,tennis,volleyball,handball',
            'prix_heure' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nom' => $request->nom,
            'type' => $request->type,
            'prix_heure' => $request->prix_heure,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('terrains', $imageName, 'public');
            $data['image'] = 'terrains/' . $imageName;
        }

        Terrain::create($data);

        return redirect()->route('admin.terrains')->with('success', 'Terrain créé avec succès.');
    }

    public function editTerrain(Terrain $terrain)
    {
        return view('admin.terrains-edit', compact('terrain'));
    }

    public function updateTerrain(Request $request, Terrain $terrain)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:football,basketball,tennis,volleyball,handball',
            'prix_heure' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nom' => $request->nom,
            'type' => $request->type,
            'prix_heure' => $request->prix_heure,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($terrain->image && Storage::disk('public')->exists($terrain->image)) {
                Storage::disk('public')->delete($terrain->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('terrains', $imageName, 'public');
            $data['image'] = 'terrains/' . $imageName;
        }

        $terrain->update($data);

        return redirect()->route('admin.terrains')->with('success', 'Terrain mis à jour avec succès.');
    }

    public function deleteTerrain(Terrain $terrain)
    {
        // Supprimer l'image si elle existe
        if ($terrain->image && Storage::disk('public')->exists($terrain->image)) {
            Storage::disk('public')->delete($terrain->image);
        }

        $terrain->delete();
        return redirect()->route('admin.terrains')->with('success', 'Terrain supprimé avec succès.');
    }

    // Gestion des équipements
    public function equipements()
    {
        $equipements = Equipement::paginate(15);
        return view('admin.equipements', compact('equipements'));
    }

    public function createEquipement()
    {
        return view('admin.equipements-create');
    }

    public function storeEquipement(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer|min:0',
            'prix_location' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Equipement::create($request->only(['nom', 'quantite', 'prix_location', 'description']));

        return redirect()->route('admin.equipements')->with('success', 'Équipement créé avec succès.');
    }

    public function editEquipement(Equipement $equipement)
    {
        return view('admin.equipements-edit', compact('equipement'));
    }

    public function updateEquipement(Request $request, Equipement $equipement)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|integer|min:0',
            'prix_location' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $equipement->update($request->only(['nom', 'quantite', 'prix_location', 'description']));

        return redirect()->route('admin.equipements')->with('success', 'Équipement mis à jour avec succès.');
    }

    public function deleteEquipement(Equipement $equipement)
    {
        $equipement->delete();
        return redirect()->route('admin.equipements')->with('success', 'Équipement supprimé avec succès.');
    }
}