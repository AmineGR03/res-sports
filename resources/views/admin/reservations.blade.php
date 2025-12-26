@extends('layouts.admin')

@section('title', 'Gestion des Réservations')

@section('admin-content')
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <h3 class="text-lg font-semibold text-gray-900">Liste des réservations</h3>

                <!-- Barre de recherche -->
                <div class="flex">
                    <form method="GET" action="{{ route('admin.reservations') }}" class="flex">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Rechercher par nom ou email..."
                               class="px-3 py-2 border border-gray-300 rounded-l-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.reservations') }}" class="ml-2 bg-gray-500 text-white px-3 py-2 rounded-lg hover:bg-gray-600 transition duration-150 ease-in-out text-sm">
                                Effacer
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Filtres de statut -->
            <div class="mt-4 flex flex-wrap items-center space-x-2">
                <span class="text-sm text-gray-600 mr-2">Filtrer par statut:</span>
                <a href="{{ route('admin.reservations') }}"
                   class="px-3 py-1 text-sm font-medium rounded-full {{ !request('status') ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-150 ease-in-out">
                    Tous
                </a>
                <a href="{{ route('admin.reservations') }}?status=en_attente"
                   class="px-3 py-1 text-sm font-medium rounded-full {{ request('status') === 'en_attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-150 ease-in-out">
                    En attente
                </a>
                <a href="{{ route('admin.reservations') }}?status=confirmee"
                   class="px-3 py-1 text-sm font-medium rounded-full {{ request('status') === 'confirmee' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-150 ease-in-out">
                    Confirmées
                </a>
                <a href="{{ route('admin.reservations') }}?status=annulee"
                   class="px-3 py-1 text-sm font-medium rounded-full {{ request('status') === 'annulee' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition duration-150 ease-in-out">
                    Annulées
                </a>
            </div>
        </div>

        <div class="p-6">
            @if($reservations->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Réservation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terrain</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Heure</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($reservations as $reservation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">#{{ $reservation->id }}</div>
                                        <div class="text-sm text-gray-500">{{ $reservation->created_at->format('d/m/Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $reservation->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $reservation->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $reservation->terrain->nom }}</div>
                                        <div class="text-sm text-gray-500">{{ ucfirst($reservation->terrain->type) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $reservation->date->format('d/m/Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $reservation->heure_debut }} ({{ $reservation->duree }}h)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            @if($reservation->statut === 'confirmee') bg-green-100 text-green-800
                                            @elseif($reservation->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                            @elseif($reservation->statut === 'annulee') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($reservation->statut) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ number_format($reservation->total, 2) }}€
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.reservations.show', $reservation) }}"
                                               class="text-indigo-600 hover:text-indigo-900">Voir</a>

                                            @if($reservation->statut === 'en_attente')
                                                <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="statut" value="confirmee">
                                                    <button type="submit" class="text-green-600 hover:text-green-900">Confirmer</button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="statut" value="annulee">
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Annuler</button>
                                                </form>
                                            @elseif($reservation->statut === 'confirmee')
                                                <form method="POST" action="{{ route('admin.reservations.status', $reservation) }}" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="statut" value="terminee">
                                                    <button type="submit" class="text-blue-600 hover:text-blue-900">Terminer</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $reservations->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune réservation trouvée</h3>
                    <p class="text-gray-500">
                        @if(request('status') || request('search'))
                            Aucune réservation ne correspond à vos critères de recherche.
                        @else
                            Il n'y a pas encore de réservations.
                        @endif
                    </p>
                    @if(request('status') || request('search'))
                        <a href="{{ route('admin.reservations') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-600 bg-indigo-100 hover:bg-indigo-200">
                            Voir toutes les réservations
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
