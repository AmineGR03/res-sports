@extends('layouts.admin')

@section('title', 'Créer un utilisateur')

@section('admin-content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-500 to-red-600">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Créer un nouvel utilisateur
                </h2>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom complet *
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Adresse email *
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Téléphone -->
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                            Téléphone
                        </label>
                        <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                               placeholder="01 23 45 67 89">
                        @error('telephone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rôle -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                            Rôle *
                        </label>
                        <select id="role" name="role"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('role') border-red-500 @enderror"
                                required>
                            <option value="">Sélectionner un rôle</option>
                            <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrateur</option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Mot de passe *
                        </label>
                        <input type="password" id="password" name="password"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('password') border-red-500 @enderror"
                               required>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirmer le mot de passe *
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                               required>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users') }}"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
                        Annuler
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-150 ease-in-out font-medium">
                        Créer l'utilisateur
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
