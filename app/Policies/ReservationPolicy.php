<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReservationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Tous les utilisateurs peuvent voir leurs propres réservations
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Reservation $reservation): bool
    {
        // L'utilisateur peut voir sa propre réservation OU un admin peut voir toutes les réservations
        return $user->id === $reservation->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isClient(); // Seuls les clients peuvent créer des réservations
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Reservation $reservation): bool
    {
        // L'utilisateur peut modifier sa propre réservation seulement si elle est en attente
        return $user->id === $reservation->user_id && $reservation->statut === 'en_attente';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Reservation $reservation): bool
    {
        // L'utilisateur peut annuler sa propre réservation seulement si elle est en attente
        return $user->id === $reservation->user_id && $reservation->statut === 'en_attente';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Reservation $reservation): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Reservation $reservation): bool
    {
        //
    }
}
