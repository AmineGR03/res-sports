@extends('layouts.app')

@section('title', 'Terrains Disponibles')

@section('header')
    <div class="flex items-center">
        <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <div>
            <h1 class="text-3xl font-bold text-white">Terrains Disponibles</h1>
            <p class="text-indigo-100 mt-1">Réservez votre terrain sportif préféré</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                    <div class="flex items-center">
                        <div class="gradient-bg rounded-lg p-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h2a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Terrains</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $terrains->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                    <div class="flex items-center">
                        <div class="bg-green-500 rounded-lg p-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Disponibles</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $terrains->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                    <div class="flex items-center">
                        <div class="bg-blue-500 rounded-lg p-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Prix moyen</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($terrains->avg('prix_heure'), 0) }}€</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                    <div class="flex items-center">
                        <div class="bg-purple-500 rounded-lg p-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Sports</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $terrains->unique('type')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Terrains Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($terrains as $terrain)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold text-gray-900">
                                    {{ $terrain->nom }}
                                </h3>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($terrain->type === 'football') bg-green-100 text-green-800 border border-green-200
                                    @elseif($terrain->type === 'basketball') bg-orange-100 text-orange-800 border border-orange-200
                                    @elseif($terrain->type === 'tennis') bg-blue-100 text-blue-800 border border-blue-200
                                    @elseif($terrain->type === 'volleyball') bg-purple-100 text-purple-800 border border-purple-200
                                    @else bg-gray-100 text-gray-800 border border-gray-200
                                    @endif">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    {{ ucfirst($terrain->type) }}
                                </span>
                            </div>

                            @if($terrain->description)
                                <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                                    {{ $terrain->description }}
                                </p>
                            @endif

                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <span class="text-3xl font-bold gradient-bg bg-clip-text text-transparent">
                                        {{ number_format($terrain->prix_heure, 2) }}€
                                    </span>
                                    <p class="text-sm text-gray-500">par heure</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-500">À partir de</div>
                                    <div class="text-lg font-semibold text-gray-900">9h00</div>
                                </div>
                            </div>

                            <a href="{{ route('terrains.show', $terrain) }}"
                               class="w-full gradient-bg text-white font-semibold py-3 px-4 rounded-lg text-center transition duration-300 ease-in-out hover:shadow-lg hover:scale-105 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Voir les créneaux
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($terrains->isEmpty())
                <div class="text-center py-16">
                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Aucun terrain disponible</h3>
                    <p class="text-gray-500">
                        Il n'y a actuellement aucun terrain disponible pour le moment.
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
