@extends('layouts.app')

@section('title', 'Tableau de Bord - Res-Sports')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <div class="bg-white bg-opacity-20 p-4 rounded-2xl">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h2a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    @auth
                        Bienvenue, {{ Auth::user()->name }} !
                    @else
                        Bienvenue sur Res-Sports
                    @endauth
                </h1>
                <p class="text-xl text-indigo-100 max-w-3xl mx-auto leading-relaxed">
                    @auth
                        Gérez vos réservations sportives et explorez nos terrains disponibles
                    @else
                        Découvrez nos terrains sportifs et réservez facilement vos créneaux préférés
                    @endauth
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-12">

            @auth
                <!-- Statistics Section -->
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Mes Statistiques
                        </h2>
                    </div>

                    <div class="p-8">
                        @if(auth()->user()->isClient())
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Mes Réservations -->
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-blue-600 text-sm font-semibold mb-1">Total Réservations</p>
                                        <p class="text-3xl font-bold text-blue-900">{{ Auth::user()->reservations->count() }}</p>
                                        <p class="text-blue-500 text-xs mt-1">Toutes périodes</p>
                                    </div>
                                    <div class="bg-blue-500 rounded-xl p-3">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Réservations Actives -->
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-green-600 text-sm font-semibold mb-1">Réservations Actives</p>
                                        <p class="text-3xl font-bold text-green-900">{{ Auth::user()->reservations->whereIn('statut', ['en_attente', 'confirmee'])->count() }}</p>
                                        <p class="text-green-500 text-xs mt-1">À venir</p>
                                    </div>
                                    <div class="bg-green-500 rounded-xl p-3">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Réservations Terminées -->
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-purple-600 text-sm font-semibold mb-1">Historique</p>
                                        <p class="text-3xl font-bold text-purple-900">{{ Auth::user()->reservations->where('statut', 'terminee')->count() }}</p>
                                        <p class="text-purple-500 text-xs mt-1">Terminées</p>
                                    </div>
                                    <div class="bg-purple-500 rounded-xl p-3">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="text-center py-8">
                            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-6 border border-red-200">
                                <svg class="w-12 h-12 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="text-lg font-semibold text-red-900 mb-2">Panneau d'Administration</h3>
                                <p class="text-red-600">En tant qu'administrateur, vous avez accès à la gestion complète du système via le menu "Administration".</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions Section -->
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Actions Rapides
                        </h2>
                    </div>

                    <div class="p-8">
                        @if(auth()->user()->isClient())
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <a href="{{ route('terrains.index') }}"
                               class="group bg-gradient-to-br from-indigo-50 to-indigo-100 hover:from-indigo-100 hover:to-indigo-200 p-6 rounded-2xl border border-indigo-200 hover:border-indigo-300 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center justify-center mb-4">
                                    <div class="bg-indigo-500 p-4 rounded-2xl group-hover:bg-indigo-600 transition-colors duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-900 transition-colors">Voir les Terrains</h4>
                                    <p class="text-gray-600 text-sm mt-1">Explorer tous les terrains disponibles</p>
                                </div>
                            </a>

                            <a href="{{ route('reservations.index') }}"
                               class="group bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 p-6 rounded-2xl border border-green-200 hover:border-green-300 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center justify-center mb-4">
                                    <div class="bg-green-500 p-4 rounded-2xl group-hover:bg-green-600 transition-colors duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-lg font-semibold text-gray-900 group-hover:text-green-900 transition-colors">Mes Réservations</h4>
                                    <p class="text-gray-600 text-sm mt-1">Gérer vos réservations existantes</p>
                                </div>
                            </a>

                            <a href="{{ route('profile.show') }}"
                               class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 p-6 rounded-2xl border border-purple-200 hover:border-purple-300 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center justify-center mb-4">
                                    <div class="bg-purple-500 p-4 rounded-2xl group-hover:bg-purple-600 transition-colors duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-lg font-semibold text-gray-900 group-hover:text-purple-900 transition-colors">Mon Profil</h4>
                                    <p class="text-gray-600 text-sm mt-1">Modifier vos informations</p>
                                </div>
                            </a>
                        </div>
                        @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <a href="{{ route('admin.dashboard') }}"
                               class="group bg-gradient-to-br from-red-50 to-red-100 hover:from-red-100 hover:to-red-200 p-6 rounded-2xl border border-red-200 hover:border-red-300 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center justify-center mb-4">
                                    <div class="bg-red-500 p-4 rounded-2xl group-hover:bg-red-600 transition-colors duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-lg font-semibold text-gray-900 group-hover:text-red-900 transition-colors">Administration</h4>
                                    <p class="text-gray-600 text-sm mt-1">Gérer le système complet</p>
                                </div>
                            </a>

                            <a href="{{ route('profile.show') }}"
                               class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 p-6 rounded-2xl border border-purple-200 hover:border-purple-300 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center justify-center mb-4">
                                    <div class="bg-purple-500 p-4 rounded-2xl group-hover:bg-purple-600 transition-colors duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-lg font-semibold text-gray-900 group-hover:text-purple-900 transition-colors">Mon Profil</h4>
                                    <p class="text-gray-600 text-sm mt-1">Modifier vos informations</p>
                                </div>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

            @else
                <!-- Call to Action for Non-Authenticated Users -->
                <div class="text-center py-12">
                    <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-3xl p-12 border-2 border-dashed border-indigo-200 shadow-2xl">
                        <svg class="w-20 h-20 text-indigo-500 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Connectez-vous pour accéder à vos réservations</h3>
                        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">Créez un compte ou connectez-vous pour voir vos statistiques personnelles et gérer vos réservations sportives.</p>
                        <div class="flex flex-col sm:flex-row gap-6 justify-center max-w-md mx-auto">
                            <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition duration-300 ease-in-out hover:shadow-xl hover:scale-105 flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Se connecter
                            </a>
                            <a href="{{ route('register') }}" class="bg-white hover:bg-gray-50 text-indigo-600 px-8 py-4 rounded-xl font-semibold text-lg border-2 border-indigo-200 transition duration-300 ease-in-out hover:shadow-xl hover:scale-105 flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Créer un compte
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Popular Terrains for Guests -->
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-600 to-red-600 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            Terrains Populaires
                        </h2>
                    </div>

                    <div class="p-8">
                        @if($popular_terrains->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($popular_terrains as $terrain)
                                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($terrain->type === 'football')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h2a2 2 0 012 2v2H8V5z"></path>
                                                    @elseif($terrain->type === 'basketball')
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    @elseif($terrain->type === 'tennis')
                                                        <rect x="4" y="6" width="16" height="12" rx="2"></rect>
                                                        <line x1="8" y1="10" x2="16" y2="10"></line>
                                                        <line x1="12" y1="6" x2="12" y2="18"></line>
                                                    @else
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <path d="m9 12 2 2 4-4"></path>
                                                    @endif
                                                </svg>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-bold text-green-600">{{ number_format($terrain->prix_heure, 2) }}€</p>
                                                <p class="text-xs text-gray-500">par heure</p>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <h4 class="text-lg font-semibold text-gray-900 mb-1">{{ $terrain->nom }}</h4>
                                            <p class="text-gray-600 text-sm capitalize">{{ $terrain->type }}</p>
                                        </div>
                                        <a href="{{ route('login') }}"
                                           class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-300 ease-in-out hover:shadow-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                            </svg>
                                            Se connecter pour réserver
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="w-20 h-20 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <h3 class="text-2xl font-medium text-gray-900 mb-3">Aucun terrain disponible</h3>
                                <p class="text-lg text-gray-500 max-w-md mx-auto">Les terrains apparaîtront ici une fois ajoutés par l'administrateur.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endauth

        </div>
    </div>
</div>
@endsection