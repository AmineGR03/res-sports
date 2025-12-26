<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'telephone' => 'required|string|max:20',
            'current_password' => 'required_with:new_password|string',
            'new_password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Vérifier le mot de passe actuel si on veut changer le mot de passe
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
            }
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
        ];

        // Gérer l'upload d'avatar
        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar si il existe
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('avatars', $avatarName, 'public');
            $data['avatar'] = 'avatars/' . $avatarName;
        }

        // Mettre à jour le mot de passe si fourni
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }

        $user->update($data);

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour avec succès.');
    }
}
