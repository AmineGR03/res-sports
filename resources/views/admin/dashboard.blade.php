@extends('layouts.admin')

@section('title', 'Dashboard Administration')

@section('admin-content')
    <div class="space-y-6">
        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Réservations</p>
                        <p class="text-3xl font-bold">{{ $stats['total_reservations'] }}</p>
                    </div>
                    <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">En attente</p>
                        <p class="text-3xl font-bold">{{ $stats['pending_reservations'] }}</p>
                    </div>
                    <svg class="w-8 h-8 text-yellow-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Confirmées</p>
                        <p class="text-3xl font-bold">{{ $stats['confirmed_reservations'] }}</p>
                    </div>
                    <svg class="w-8 h-8 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium">Annulées</p>
                        <p class="text-3xl font-bold">{{ $stats['cancelled_reservations'] }}</p>
                    </div>
                    <svg class="w-8 h-8 text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.reservations') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center transition duration-150 ease-in-out">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="text-sm font-medium">Voir réservations</span>
                </a>

                <a href="{{ route('admin.users') }}" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center transition duration-150 ease-in-out">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">Gérer utilisateurs</span>
                </a>

                <a href="{{ route('admin.terrains') }}" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg text-center transition duration-150 ease-in-out">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span class="text-sm font-medium">Gérer terrains</span>
                </a>

                <a href="{{ route('admin.equipements') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-4 rounded-lg text-center transition duration-150 ease-in-out">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="text-sm font-medium">Gérer équipements</span>
                </a>
            </div>
        </div>

        <!-- Réservations récentes -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Réservations récentes</h3>
                    <a href="{{ route('admin.reservations') }}" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                        Voir tout →
                    </a>
                </div>
            </div>

            <div class="p-6">
                @if($recentReservations->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentReservations as $reservation)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-150 ease-in-out">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">
                                            {{ substr($reservation->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $reservation->user->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $reservation->terrain->nom }} • {{ $reservation->date->format('d/m/Y') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                        @if($reservation->statut === 'confirmee') bg-green-100 text-green-800
                                        @elseif($reservation->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                        @elseif($reservation->statut === 'annulee') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($reservation->statut) }}
                                    </span>

                                    <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                                        Détails
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune réservation récente</h3>
                        <p class="text-gray-500">Les nouvelles réservations apparaîtront ici.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection