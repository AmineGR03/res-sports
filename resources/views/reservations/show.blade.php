@extends('layouts.app')

@section('title', 'Réservation #' . $reservation->id . ' - Res-Sports')

@section('header')
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <div>
                <h1 class="text-3xl font-bold text-white">Réservation #{{ $reservation->id }}</h1>
                <p class="text-indigo-100 mt-1">{{ $reservation->terrain->nom }}</p>
            </div>
        </div>
        <a href="{{ route('reservations.index') }}"
           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour aux réservations
        </a>
    </div>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Status Banner -->
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center
                            @if($reservation->statut === 'confirmee') bg-green-100
                            @elseif($reservation->statut === 'en_attente') bg-yellow-100
                            @elseif($reservation->statut === 'annulee') bg-red-100
                            @else bg-gray-100
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
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">
                                Statut: {{ ucfirst($reservation->statut) }}
                            </h2>
                            <p class="text-gray-600 mt-1">
                                @if($reservation->statut === 'confirmee')
                                    Votre réservation est confirmée
                                @elseif($reservation->statut === 'en_attente')
                                    En attente de confirmation
                                @elseif($reservation->statut === 'annulee')
                                    Cette réservation a été annulée
                                @else
                                    Réservation terminée
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($reservation->statut === 'en_attente' && $reservation->date->isFuture())
                        <form method="POST" action="{{ route('reservations.cancel', $reservation) }}"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                            @csrf
                            @method('POST')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out">
                                Annuler la réservation
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Reservation Details -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Main Details -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="gradient-bg px-6 py-4">
                    <h3 class="text-xl font-bold text-white">Détails de la réservation</h3>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Terrain Info -->
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($reservation->terrain->type === 'football')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h2a2 2 0 012 2v2H8V5z"></path>
                                @elseif($reservation->terrain->type === 'basketball')
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="3"></circle>
                                @elseif($reservation->terrain->type === 'tennis')
                                    <rect x="4" y="6" width="16" height="12" rx="2"></rect>
                                    <line x1="8" y1="10" x2="16" y2="10"></line>
                                    <line x1="12" y1="6" x2="12" y2="18"></line>
                                @else
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="m9 12 2 2 4-4"></path>
                                @endif
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $reservation->terrain->nom }}</h4>
                            <p class="text-gray-600">{{ ucfirst($reservation->terrain->type) }}</p>
                            @if($reservation->terrain->description)
                                <p class="text-sm text-gray-500 mt-1">{{ $reservation->terrain->description }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Date & Time -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Date</span>
                            </div>
                            <p class="text-lg font-semibold text-gray-900">{{ $reservation->date->format('d/m/Y') }}</p>
                            <p class="text-sm text-gray-600">{{ $reservation->date->format('l') }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Créneau</span>
                            </div>
                            <p class="text-lg font-semibold text-gray-900">{{ $reservation->heure_debut }}</p>
                            <p class="text-sm text-gray-600">à {{ $reservation->heureFin }}</p>
                        </div>
                    </div>

                    <!-- Duration & Price -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Durée</span>
                            </div>
                            <p class="text-lg font-semibold text-gray-900">{{ $reservation->duree }} heure(s)</p>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border border-green-200">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Total</span>
                            </div>
                            <p class="text-2xl font-bold text-green-600">{{ number_format($reservation->total, 2) }}€</p>
                        </div>
                    </div>

                    @if($reservation->notes)
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Notes</span>
                            </div>
                            <p class="text-gray-700">{{ $reservation->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Equipment & Actions -->
            <div class="space-y-8">
                <!-- Equipment -->
                @if($reservation->equipements->count() > 0)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="gradient-bg px-6 py-4">
                            <h3 class="text-xl font-bold text-white">Équipements réservés</h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach($reservation->equipements as $equipement)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                <span class="text-white font-bold text-sm">{{ substr($equipement->nom, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $equipement->nom }}</h4>
                                                <p class="text-sm text-gray-600">{{ $equipement->description ?? 'Équipement sportif' }}</p>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <p class="font-semibold text-gray-900">Quantité: {{ $equipement->pivot->quantite }}</p>
                                            @if($equipement->prix_location)
                                                <p class="text-sm text-gray-600">{{ number_format($equipement->prix_location * $equipement->pivot->quantite, 2) }}€</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Reservation Info -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4">
                        <h3 class="text-xl font-bold text-gray-900">Informations de réservation</h3>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Numéro de réservation:</span>
                            <span class="font-semibold text-gray-900">#{{ $reservation->id }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Date de réservation:</span>
                            <span class="font-semibold text-gray-900">{{ $reservation->created_at->format('d/m/Y à H:i') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-600">Dernière modification:</span>
                            <span class="font-semibold text-gray-900">{{ $reservation->updated_at->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        @if($reservation->statut === 'en_attente' && $reservation->date->isFuture())
                            <form method="POST" action="{{ route('reservations.cancel', $reservation) }}"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ? Cette action est irréversible.')"
                                  class="w-full">
                                @csrf
                                @method('POST')
                                <button type="submit"
                                        class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Annuler la réservation
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('terrains.show', [$reservation->terrain, 'date' => $reservation->date->format('Y-m-d')]) }}"
                           class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Voir le terrain
                        </a>

                        <a href="mailto:support@res-sports.com?subject=Aide pour réservation #{{ $reservation->id }}"
                           class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Contacter le support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
