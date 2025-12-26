@extends('layouts.admin')

@section('title', 'Réservation #' . $reservation->id)

@section('admin-content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header avec statut -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center
                        @if($reservation->statut === 'confirmee') bg-green-100
                        @elseif($reservation->statut === 'en_attente') bg-yellow-100
                        @elseif($reservation->statut === 'annulee') bg-red-100
                        @else bg-blue-100
                        @endif">
                        @if($reservation->statut === 'confirmee')
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @elseif($reservation->statut === 'en_attente')
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @elseif($reservation->statut === 'annulee')
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @else
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Réservation #{{ $reservation->id }}</h2>
                        <p class="text-gray-600 mt-1">
                            Statut: <span class="font-semibold
                                @if($reservation->statut === 'confirmee') text-green-600
                                @elseif($reservation->statut === 'en_attente') text-yellow-600
                                @elseif($reservation->statut === 'annulee') text-red-600
                                @else text-blue-600
                                @endif">
                                {{ ucfirst($reservation->statut) }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.reservations') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out">
                        ← Retour à la liste
                    </a>

                    <!-- Actions de statut rapide -->
                    @if($reservation->statut === 'en_attente')
                        <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}" class="inline">
                            @csrf
                            <input type="hidden" name="statut" value="confirmee">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out">
                                ✓ Confirmer
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}" class="inline">
                            @csrf
                            <input type="hidden" name="statut" value="annulee">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out">
                                ✕ Annuler
                            </button>
                        </form>
                    @elseif($reservation->statut === 'confirmee')
                        <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}" class="inline">
                            @csrf
                            <input type="hidden" name="statut" value="terminee">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out">
                                ✓ Marquer terminée
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Informations détaillées -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Informations client -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations client</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nom</label>
                        <p class="text-gray-900">{{ $reservation->user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Email</label>
                        <p class="text-gray-900">{{ $reservation->user->email }}</p>
                    </div>
                    @if($reservation->user->telephone)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Téléphone</label>
                            <p class="text-gray-900">{{ $reservation->user->telephone }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Informations réservation -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Détails de la réservation</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Terrain</label>
                        <p class="text-gray-900">{{ $reservation->terrain->nom }}</p>
                        <p class="text-sm text-gray-600">{{ ucfirst($reservation->terrain->type) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Date</label>
                        <p class="text-gray-900">{{ $reservation->date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Heure</label>
                        <p class="text-gray-900">{{ $reservation->heure_debut }} - {{ date('H:i', strtotime($reservation->heure_debut) + ($reservation->duree * 3600)) }}</p>
                        <p class="text-sm text-gray-600">Durée: {{ $reservation->duree }} heure(s)</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Total</label>
                        <p class="text-2xl font-bold text-indigo-600">{{ number_format($reservation->total, 2) }}€</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Équipements -->
        @if($reservation->equipements->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Équipements réservés</h3>
                <div class="space-y-3">
                    @foreach($reservation->equipements as $equipement)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">{{ substr($equipement->nom, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $equipement->nom }}</h4>
                                    <p class="text-sm text-gray-600">{{ $equipement->description ?? 'Équipement sportif' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">Quantité: {{ $equipement->pivot->quantite }}</p>
                                <p class="text-sm text-gray-600">{{ number_format($equipement->prix_location, 2) }}€ chacun</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Notes -->
        @if($reservation->notes)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Notes spéciales</h3>
                <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $reservation->notes }}</p>
            </div>
        @endif

        <!-- Historique -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Historique</h3>
            <div class="space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Réservation créée</p>
                        <p class="text-xs text-gray-500">{{ $reservation->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>

                @if($reservation->updated_at != $reservation->created_at)
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Dernière modification</p>
                            <p class="text-xs text-gray-500">{{ $reservation->updated_at->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
