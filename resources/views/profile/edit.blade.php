@extends('layouts.app')

@section('title', 'Modifier Mon Profil - ' . Auth::user()->name)

@section('header')
    <div class="flex items-center">
        <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        <div>
            <h1 class="text-3xl font-bold text-white">Modifier Mon Profil</h1>
            <p class="text-indigo-100 mt-1">Mettez à jour vos informations personnelles</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Modifier les informations</h3>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="text-center mb-6">
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

                    <div>
                        <label for="avatar" class="cursor-pointer">
                            <span class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Changer la photo
                            </span>
                            <input id="avatar" name="avatar" type="file" accept="image/*" class="sr-only">
                        </label>
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG ou GIF. Max 2MB.</p>
                    </div>
                    @error('avatar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Informations de base -->
                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informations personnelles
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nom complet *
                            </label>
                            <input type="text" id="name" name="name" required
                                   class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm @error('name') border-red-300 @enderror"
                                   placeholder="Prénom NOM"
                                   value="{{ old('name', $user->name) }}">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone *
                            </label>
                            <input type="tel" id="telephone" name="telephone" required
                                   class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm @error('telephone') border-red-300 @enderror"
                                   placeholder="06 12 34 56 78"
                                   value="{{ old('telephone', $user->telephone) }}">
                            @error('telephone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Adresse email *
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm @error('email') border-red-300 @enderror"
                               placeholder="votre@email.com"
                               value="{{ old('email', $user->email) }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sécurité -->
                <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                    <h4 class="text-lg font-semibold text-red-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Sécurité du compte
                    </h4>

                    <div class="space-y-4">
                        <div class="bg-white rounded-lg p-4 border border-red-200">
                            <h5 class="text-sm font-medium text-gray-900 mb-3">Changer le mot de passe</h5>
                            <p class="text-sm text-gray-600 mb-4">Laissez ces champs vides si vous ne voulez pas changer votre mot de passe.</p>

                            <div class="space-y-4">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Mot de passe actuel *
                                    </label>
                                    <input type="password" id="current_password" name="current_password"
                                           class="w-full rounded-lg border-gray-300 focus:ring-red-500 focus:border-red-500 @error('current_password') border-red-300 @enderror"
                                           placeholder="Votre mot de passe actuel">
                                    @error('current_password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nouveau mot de passe
                                        </label>
                                        <input type="password" id="new_password" name="new_password"
                                               class="w-full rounded-lg border-gray-300 focus:ring-red-500 focus:border-red-500 @error('new_password') border-red-300 @enderror"
                                               placeholder="Au moins 8 caractères">
                                        @error('new_password')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                            Confirmer le nouveau mot de passe
                                        </label>
                                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                               class="w-full rounded-lg border-gray-300 focus:ring-red-500 focus:border-red-500"
                                               placeholder="Retapez le mot de passe">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-yellow-800">Sécurité</h4>
                            <p class="text-sm text-yellow-700 mt-1">
                                Vos informations sont chiffrées et sécurisées. Le changement de mot de passe nécessite votre mot de passe actuel.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <a href="{{ route('profile.show') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                        ← Retour au profil
                    </a>

                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300 ease-in-out flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
