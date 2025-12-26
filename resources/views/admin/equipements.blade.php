@extends('layouts.admin')

@section('title', 'Gestion des Équipements')

@section('admin-content')
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Liste des équipements</h3>
                <a href="{{ route('admin.equipements.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out">
                    + Nouvel équipement
                </a>
            </div>
        </div>

        <div class="p-6">
            @if($equipements->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($equipements as $equipement)
                        <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition duration-150 ease-in-out">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $equipement->nom }}</h4>
                                    <div class="flex items-center space-x-4 mb-3">
                                        <span class="text-sm text-gray-600">Stock: <strong>{{ $equipement->quantite }}</strong></span>
                                        @if($equipement->prix_location)
                                            <span class="text-sm text-indigo-600 font-semibold">{{ number_format($equipement->prix_location, 2) }}€</span>
                                        @endif
                                    </div>
                                    @if($equipement->description)
                                        <p class="text-sm text-gray-700">{{ Str::limit($equipement->description, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-xs text-gray-500">ID: {{ $equipement->id }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.equipements.edit', $equipement) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Modifier</a>
                                    <form method="POST" action="{{ route('admin.equipements.destroy', $equipement) }}" class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')">
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
                    {{ $equipements->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun équipement trouvé</h3>
                    <p class="text-gray-500">Il n'y a pas encore d'équipements configurés.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
