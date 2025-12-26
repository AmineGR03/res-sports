@extends('layouts.app')

@section('title', 'Nouvelle Réservation - ' . $terrain->nom)

@section('header')
    <div class="flex items-center">
        <svg class="w-8 h-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <div>
            <h1 class="text-3xl font-bold text-white">Nouvelle Réservation</h1>
            <p class="text-indigo-100 mt-1">{{ $terrain->nom }} • {{ $date }} à {{ $heure_debut }}</p>
        </div>
    </div>
@endsection

@section('content')
    @if(!$terrain)
        <div class="max-w-2xl mx-auto">
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                <svg class="w-16 h-16 text-yellow-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <h3 class="text-lg font-medium text-yellow-800 mb-2">Terrain non sélectionné</h3>
                <p class="text-yellow-700 mb-6">Veuillez d'abord sélectionner un terrain et un créneau horaire.</p>
                <a href="{{ route('terrains.index') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg font-medium transition duration-150 ease-in-out">
                    Voir les terrains disponibles
                </a>
            </div>
        </div>
    @else
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="gradient-bg px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Détails de la réservation</h2>
                </div>

                <form method="POST" action="{{ route('reservations.store') }}" class="p-6 space-y-6">
                    @csrf

                    <input type="hidden" name="terrain_id" value="{{ $terrain->id }}">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="heure_debut" value="{{ $heure_debut }}">

                <!-- Réservation Summary -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Récapitulatif</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600">Terrain:</span>
                            <p class="font-semibold text-gray-900">{{ $terrain->nom }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Date:</span>
                            <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600">Créneau:</span>
                            <p class="font-semibold text-gray-900">{{ $heure_debut }} - {{ date('H:i', strtotime($heure_debut) + 3600) }}</p>
                        </div>
                        <div class="md:col-span-3 mt-4 md:mt-0">
                            <span class="text-gray-600">Total estimé:</span>
                            <p class="text-2xl font-bold text-indigo-600" id="total-price">{{ number_format($terrain->prix_heure, 2) }}€</p>
                        </div>
                    </div>
                </div>

                <!-- Duration Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Durée de la réservation
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @for($i = 1; $i <= 4; $i++)
                            <label class="relative">
                                <input type="radio" name="duree" value="{{ $i }}" class="sr-only peer" {{ $i == 1 ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition duration-150 ease-in-out">
                                    <div class="text-center">
                                        <div class="text-lg font-semibold text-gray-900">{{ $i }}h</div>
                                        <div class="text-sm text-gray-600">{{ number_format($terrain->prix_heure * $i, 2) }}€</div>
                                    </div>
                                </div>
                            </label>
                        @endfor
                    </div>
                    @error('duree')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Equipment Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Équipements supplémentaires (optionnel)
                    </label>
                    <div class="space-y-3">
                        @foreach($equipements as $equipement)
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <span class="text-white font-bold text-sm">{{ substr($equipement->nom, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $equipement->nom }}</h4>
                                        <p class="text-sm text-gray-600">{{ $equipement->description ?? 'Équipement sportif' }}</p>
                                        <p class="text-xs text-gray-500">Stock: {{ $equipement->quantite }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    @if($equipement->prix_location)
                                        <span class="text-sm font-semibold text-indigo-600">{{ number_format($equipement->prix_location, 2) }}€</span>
                                    @endif

                                    <div class="flex items-center space-x-2">
                                        <label class="text-sm text-gray-600">Quantité:</label>
                                        <select name="equipements[{{ $loop->index }}][quantite]"
                                                class="rounded border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500 equipment-quantity"
                                                data-equipment-id="{{ $equipement->id }}"
                                                data-price="{{ $equipement->prix_location ?? 0 }}">
                                            <option value="0">0</option>
                                            @for($i = 1; $i <= min(5, $equipement->quantite); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <input type="hidden" name="equipements[{{ $loop->index }}][id]" value="{{ $equipement->id }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('equipements')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Notes spéciales (optionnel)
                    </label>
                    <textarea id="notes" name="notes" rows="3"
                              class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Informations supplémentaires pour votre réservation..."></textarea>
                </div>

                <!-- Total -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex justify-between items-center text-xl font-semibold">
                        <span class="text-gray-900">Total estimé:</span>
                        <span class="text-indigo-600 text-2xl" id="total-price">{{ number_format($terrain->prix_heure, 2) }}€</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Ce montant sera confirmé lors de la validation de votre réservation.</p>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <a href="{{ route('terrains.show', [$terrain, 'date' => $date]) }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                        ← Retour
                    </a>

                    <button type="submit"
                            class="gradient-bg text-white font-semibold py-3 px-8 rounded-lg transition duration-300 ease-in-out hover:shadow-lg hover:scale-105 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Confirmer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Update total price based on duration selection
        document.querySelectorAll('input[name="duree"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const duration = parseInt(this.value);
                const basePrice = {{ $terrain->prix_heure }};
                const total = (basePrice * duration).toFixed(2);
                document.getElementById('total-price').textContent = total + '€';
            });
        });

        // Update total price when duration or equipment quantities change
        document.querySelectorAll('input[name="duree"]').forEach(radio => {
            radio.addEventListener('change', function() {
                updateTotalPrice();
            });
        });

        document.querySelectorAll('.equipment-quantity').forEach(select => {
            select.addEventListener('change', function() {
                updateTotalPrice();
            });
        });

        function updateTotalPrice() {
            let total = {{ $terrain->prix_heure }};
            const durationRadio = document.querySelector('input[name="duree"]:checked');
            const duration = durationRadio ? parseInt(durationRadio.value) : 1;
            total *= duration;

            // Add equipment costs
            document.querySelectorAll('.equipment-quantity').forEach(select => {
                const quantity = parseInt(select.value) || 0;
                if (quantity > 0) {
                    const price = parseFloat(select.getAttribute('data-price')) || 0;
                    total += price * quantity;
                }
            });

            document.getElementById('total-price').textContent = total.toFixed(2) + '€';
        }
    </script>
            </div>
        </div>
    @endif
@endsection
