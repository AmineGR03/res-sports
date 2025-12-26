@extends('layouts.admin')

@section('title', 'Modifier le terrain')

@section('admin-content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-500 to-green-600">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Modifier le terrain
                </h2>
            </div>

            <form method="POST" action="{{ route('admin.terrains.update', $terrain) }}" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom du terrain *
                        </label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom', $terrain->nom) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 @error('nom') border-red-500 @enderror"
                               required>
                        @error('nom')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Type de sport *
                        </label>
                        <select id="type" name="type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 @error('type') border-red-500 @enderror"
                                required>
                            <option value="">Sélectionner un sport</option>
                            <option value="football" {{ old('type', $terrain->type) === 'football' ? 'selected' : '' }}>Football</option>
                            <option value="basketball" {{ old('type', $terrain->type) === 'basketball' ? 'selected' : '' }}>Basketball</option>
                            <option value="tennis" {{ old('type', $terrain->type) === 'tennis' ? 'selected' : '' }}>Tennis</option>
                            <option value="volleyball" {{ old('type', $terrain->type) === 'volleyball' ? 'selected' : '' }}>Volleyball</option>
                            <option value="handball" {{ old('type', $terrain->type) === 'handball' ? 'selected' : '' }}>Handball</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Prix par heure -->
                <div>
                    <label for="prix_heure" class="block text-sm font-medium text-gray-700 mb-2">
                        Prix par heure (€) *
                    </label>
                    <input type="number" id="prix_heure" name="prix_heure" value="{{ old('prix_heure', $terrain->prix_heure) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 @error('prix_heure') border-red-500 @enderror"
                           step="0.01" min="0" required>
                    @error('prix_heure')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 @error('description') border-red-500 @enderror">{{ old('description', $terrain->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image actuelle -->
                @if($terrain->image)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Image actuelle
                        </label>
                        <img src="{{ $terrain->image_url }}" alt="{{ $terrain->nom }}" class="w-32 h-24 object-cover rounded-lg border">
                    </div>
                @endif

                <!-- Nouvelle image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $terrain->image ? 'Changer l\'image' : 'Image du terrain' }}
                    </label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 @error('image') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Formats acceptés: JPG, PNG, GIF. Taille max: 2MB</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.terrains') }}"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
                        Annuler
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-150 ease-in-out font-medium">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
