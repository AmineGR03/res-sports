@extends('layouts.app')

@section('title', 'Mes Réservations - Res-Sports')

@section('header')
    <div class="flex items-center">
        <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
        </svg>
        <div>
            <h1 class="text-3xl font-bold text-white">Mes Réservations</h1>
            <p class="text-indigo-100 mt-1">Historique et gestion de vos réservations</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total</p>
                        <p class="text-3xl font-bold">{{ $reservations->total() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Confirmées</p>
                        <p class="text-3xl font-bold">{{ $reservations->where('statut', 'confirmee')->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">En attente</p>
                        <p class="text-3xl font-bold">{{ $reservations->where('statut', 'en_attente')->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-yellow-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium">Annulées</p>
                        <p class="text-3xl font-bold">{{ $reservations->where('statut', 'annulee')->count() }}</p>
                    </div>
                    <svg class="w-8 h-8 text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Reservations List -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="gradient-bg px-6 py-4">
                <h2 class="text-xl font-bold text-white">Historique des réservations</h2>
            </div>

            <div class="p-6">
                @if($reservations->count() > 0)
                    <div class="space-y-4">
                        @foreach($reservations as $reservation)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition duration-150 ease-in-out">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $reservation->terrain->nom }}</h3>
                                            <p class="text-sm text-gray-600">{{ ucfirst($reservation->terrain->type) }}</p>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                            @if($reservation->statut === 'confirmee') bg-green-100 text-green-800
                                            @elseif($reservation->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                            @elseif($reservation->statut === 'annulee') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($reservation->statut) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <span class="text-sm text-gray-600">Date</span>
                                        <p class="font-semibold text-gray-900">{{ $reservation->date->format('d/m/Y') }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-600">Créneau</span>
                                        <p class="font-semibold text-gray-900">{{ $reservation->heure_debut }} - {{ $reservation->heureFin }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-600">Durée</span>
                                        <p class="font-semibold text-gray-900">{{ $reservation->duree }} heure(s)</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-600">Total</span>
                                        <p class="font-semibold text-indigo-600">{{ number_format($reservation->total, 2) }}€</p>
                                    </div>
                                </div>

                                @if($reservation->equipements->count() > 0)
                                    <div class="mb-4">
                                        <span class="text-sm text-gray-600">Équipements:</span>
                                        <div class="flex flex-wrap gap-2 mt-1">
                                            @foreach($reservation->equipements as $equipement)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    {{ $equipement->nom }} ({{ $equipement->pivot->quantite }})
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if($reservation->notes)
                                    <div class="mb-4">
                                        <span class="text-sm text-gray-600">Notes:</span>
                                        <p class="text-sm text-gray-700 mt-1">{{ $reservation->notes }}</p>
                                    </div>
                                @endif

                                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                    <div class="text-sm text-gray-600">
                                        Réservé le {{ $reservation->created_at->format('d/m/Y à H:i') }}
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('reservations.show', $reservation) }}"
                                           class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                                            Voir détails
                                        </a>

                                        @if($reservation->statut === 'en_attente' && $reservation->date->isFuture())
                                            <form method="POST" action="{{ route('reservations.cancel', $reservation) }}"
                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')"
                                                  class="inline">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="text-red-600 hover:text-red-500 text-sm font-medium">
                                                    Annuler
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $reservations->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">Aucune réservation trouvée</h3>
                        <p class="text-gray-500 mb-6">
                            Vous n'avez encore effectué aucune réservation.
                        </p>
                        <a href="{{ route('terrains.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white gradient-bg hover:shadow-lg transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Réserver un terrain
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


