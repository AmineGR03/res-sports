@extends('layouts.admin')

@section('title', 'Modifier l\'équipement')

@section('admin-content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-500 to-purple-600">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Modifier l'équipement
                </h2>
            </div>

            <form method="POST" action="{{ route('admin.equipements.update', $equipement) }}" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom de l'équipement *
                        </label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom', $equipement->nom) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 @error('nom') border-red-500 @enderror"
                               required>
                        @error('nom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quantité -->
                    <div>
                        <label for="quantite" class="block text-sm font-medium text-gray-700 mb-2">
                            Quantité disponible *
                        </label>
                        <input type="number" id="quantite" name="quantite" value="{{ old('quantite', $equipement->quantite) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 @error('quantite') border-red-500 @enderror"
                               min="0" required>
                        @error('quantite')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Prix de location -->
                <div>
                    <label for="prix_location" class="block text-sm font-medium text-gray-700 mb-2">
                        Prix de location (€)
                    </label>
                    <input type="number" id="prix_location" name="prix_location" value="{{ old('prix_location', $equipement->prix_location) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 @error('prix_location') border-red-500 @enderror"
                           step="0.01" min="0">
                    @error('prix_location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 @error('description') border-red-500 @enderror">{{ old('description', $equipement->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.equipements') }}"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
                        Annuler
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-150 ease-in-out font-medium">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
