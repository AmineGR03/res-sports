@extends('layouts.app')

@section('title', 'Mon Profil - ' . Auth::user()->name)

@section('header')
    <div class="flex items-center">
        <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <div>
            <h1 class="text-3xl font-bold text-white">Mon Profil</h1>
            <p class="text-indigo-100 mt-1">Gérez vos informations personnelles</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Messages flash -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Informations générales -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Informations générales</h3>
                            <a href="{{ route('profile.edit') }}"
                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Modifier
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                                <div class="bg-gray-50 rounded-lg px-4 py-3">
                                    <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                                <div class="bg-gray-50 rounded-lg px-4 py-3">
                                    <p class="text-gray-900">{{ $user->email }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                                <div class="bg-gray-50 rounded-lg px-4 py-3">
                                    <p class="text-gray-900">{{ $user->telephone ?? 'Non spécifié' }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                                <div class="bg-gray-50 rounded-lg px-4 py-3">
                                    <span class="inline-flex px-2 py-1 text-sm font-semibold rounded-full
                                        @if($user->role === 'admin') bg-red-100 text-red-800
                                        @else bg-blue-100 text-blue-800
                                        @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <span>Membre depuis le {{ $user->created_at->format('d/m/Y') }}</span>
                                <span>Dernière mise à jour: {{ $user->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Avatar et statistiques -->
            <div class="space-y-6">
                <!-- Avatar -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Photo de profil</h3>
                    <div class="text-center">
                        @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}"
                                 alt="Avatar de {{ $user->name }}"
                                 class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-indigo-200">
                        @else
                            <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <span class="text-2xl font-bold text-white">
                                    {{ substr($user->name, 0, 1) }}
                                </span>
                            </div>
                        @endif
                        <p class="text-sm text-gray-600">
                            @if($user->avatar)
                                Photo personnalisée
                            @else
                                Photo par défaut
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistiques</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Réservations totales</span>
                            <span class="font-semibold text-gray-900">{{ $user->reservations->count() }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Réservations actives</span>
                            <span class="font-semibold text-green-600">
                                {{ $user->reservations->whereIn('statut', ['en_attente', 'confirmee'])->count() }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Réservations terminées</span>
                            <span class="font-semibold text-blue-600">
                                {{ $user->reservations->where('statut', 'terminee')->count() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h3>
                    <div class="space-y-3">
                        <a href="{{ route('terrains.index') }}"
                           class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Réserver un terrain
                        </a>

                        <a href="{{ route('reservations.index') }}"
                           class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Mes réservations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


