@extends('layouts.admin')

@section('title', 'Gestion des Terrains')

@section('admin-content')
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Liste des terrains</h3>
                <a href="{{ route('admin.terrains.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out">
                    + Nouveau terrain
                </a>
            </div>
        </div>

        <div class="p-6">
            @if($terrains->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($terrains as $terrain)
                        <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition duration-150 ease-in-out">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $terrain->nom }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ ucfirst($terrain->type) }}</p>
                                    <p class="text-2xl font-bold text-indigo-600 mb-4">{{ number_format($terrain->prix_heure, 2) }}€/h</p>
                                    @if($terrain->description)
                                        <p class="text-sm text-gray-700">{{ Str::limit($terrain->description, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-xs text-gray-500">ID: {{ $terrain->id }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.terrains.edit', $terrain) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Modifier</a>
                                    <form method="POST" action="{{ route('admin.terrains.destroy', $terrain) }}" class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce terrain ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 border-none bg-transparent p-0 text-sm font-medium">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $terrains->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun terrain trouvé</h3>
                    <p class="text-gray-500">Il n'y a pas encore de terrains configurés.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
