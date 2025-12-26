@extends('layouts.app')

@section('title', $terrain->nom . ' - Créneaux disponibles')

@section('header')
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <svg class="w-10 h-10 text-white mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div>
                <h1 class="text-3xl font-bold text-white">{{ $terrain->nom }}</h1>
                <p class="text-indigo-100 mt-1">{{ ucfirst($terrain->type) }} • {{ number_format($terrain->prix_heure, 2) }}€/heure</p>
            </div>
        </div>
        <a href="{{ route('terrains.index') }}"
           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour aux terrains
        </a>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations du terrain -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="gradient-bg px-6 py-4">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h2 class="text-2xl font-bold">{{ $terrain->nom }}</h2>
                            <p class="text-indigo-100">{{ ucfirst($terrain->type) }}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-4xl font-bold">
                                {{ number_format($terrain->prix_heure, 2) }}€
                            </div>
                            <div class="text-sm text-indigo-100">par heure</div>
                        </div>
                    </div>
                </div>

                <!-- Image du terrain -->
                <div class="px-6 py-4">
                    <div class="relative overflow-hidden rounded-lg shadow-lg">
                        <img src="{{ $terrain->image_url }}"
                             alt="Image de {{ $terrain->nom }}"
                             class="w-full h-64 md:h-80 object-cover hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <!-- Bouton pour agrandir l'image -->
                    <div class="mt-4 text-center">
                        <button id="enlarge-image-btn"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition duration-150 ease-in-out shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Voir en grand
                        </button>
                    </div>

                    @if($terrain->hasValidImage())
                        <p class="text-sm text-gray-500 mt-2 text-center">Cliquez sur le bouton pour agrandir l'image</p>
                    @else
                        <p class="text-sm text-indigo-600 mt-2 text-center font-medium">Image par défaut du terrain</p>
                    @endif
                </div>

                @if($terrain->description)
                    <div class="px-6 py-4">
                        <p class="text-gray-700 leading-relaxed">{{ $terrain->description }}</p>
                    </div>
                @endif
            </div>

            <!-- Sélecteur de date -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center mb-6">
                    <svg class="w-6 h-6 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Choisir une date</h3>
                </div>
                <form method="GET" class="flex flex-col sm:flex-row items-start sm:items-end space-y-4 sm:space-y-0 sm:space-x-4">
                    <div class="w-full sm:w-auto">
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                            Date de réservation
                        </label>
                        <input type="date"
                               id="date"
                               name="date"
                               value="{{ $date }}"
                               min="{{ date('Y-m-d') }}"
                               class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
                    </div>
                    <button type="submit"
                            class="gradient-bg text-white font-semibold py-2 px-6 rounded-lg transition duration-300 ease-in-out hover:shadow-lg hover:scale-105 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Voir les créneaux
                    </button>
                </form>
            </div>

            <!-- Créneaux disponibles -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="gradient-bg px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Créneaux disponibles - {{ \Carbon\Carbon::parse($date)->format('l d F Y') }}
                    </h3>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-8">
                        @foreach($creneaux as $creneau)
                            <div class="text-center">
                                @if($creneau['disponible'])
                                    <button class="w-full bg-gradient-to-br from-green-400 to-green-500 hover:from-green-500 hover:to-green-600 text-white font-bold py-4 px-3 rounded-xl shadow-lg transition duration-300 ease-in-out transform hover:scale-105 creneau-disponible"
                                            data-heure-debut="{{ $creneau['heure_debut'] }}"
                                            data-heure-fin="{{ $creneau['heure_fin'] }}"
                                            data-date="{{ $date }}"
                                            data-terrain-id="{{ $terrain->id }}">
                                        <div class="text-lg">{{ $creneau['heure_debut'] }}</div>
                                        <div class="text-xs opacity-90">à {{ $creneau['heure_fin'] }}</div>
                                    </button>
                                @else
                                    <div class="w-full bg-gradient-to-br from-red-400 to-red-500 text-white font-bold py-4 px-3 rounded-xl shadow-lg opacity-60 cursor-not-allowed">
                                        <div class="text-lg">{{ $creneau['heure_debut'] }}</div>
                                        <div class="text-xs opacity-90">à {{ $creneau['heure_fin'] }}</div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Légende -->
                    <div class="flex flex-wrap items-center justify-center space-x-6 text-sm">
                        <div class="flex items-center bg-green-100 rounded-lg px-3 py-2 border border-green-200">
                            <div class="w-4 h-4 bg-gradient-to-br from-green-400 to-green-500 rounded mr-2"></div>
                            <span class="font-medium text-green-800">Disponible</span>
                        </div>
                        <div class="flex items-center bg-red-100 rounded-lg px-3 py-2 border border-red-200">
                            <div class="w-4 h-4 bg-gradient-to-br from-red-400 to-red-500 rounded mr-2"></div>
                            <span class="font-medium text-red-800">Réservé</span>
                        </div>
                    </div>

                    <!-- Informations supplémentaires -->
                    <div class="mt-8 bg-gray-50 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-1">Informations importantes</h4>
                                <ul class="text-sm text-gray-600 space-y-1">
                                    <li>• Les créneaux sont disponibles de 8h00 à 22h00</li>
                                    <li>• Chaque créneau dure 1 heure minimum</li>
                                    <li>• Paiement requis à la confirmation de réservation</li>
                                    <li>• Annulation possible jusqu'à 24h avant le créneau</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de réservation -->
    <div id="reservation-modal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900" id="modal-title">Confirmer la réservation</h3>
                    <button id="modal-close" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="px-1 py-3">
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-600">Terrain:</span>
                            <span class="font-medium text-gray-900" id="modal-terrain">{{ $terrain->nom }}</span>
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-600">Date:</span>
                            <span class="font-medium text-gray-900" id="modal-date"></span>
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-600">Créneau:</span>
                            <span class="font-medium text-gray-900" id="modal-time"></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Prix:</span>
                            <span class="font-bold text-indigo-600" id="modal-price"></span>
                        </div>
                    </div>

                    <p class="text-sm text-gray-600 text-center mb-6">
                        En confirmant cette réservation, vous acceptez nos conditions d'utilisation.
                    </p>
                </div>

                <div class="flex items-center space-x-3">
                    <button id="modal-cancel" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-xl transition duration-150 ease-in-out">
                        Annuler
                    </button>
                    <button id="modal-confirm" class="flex-1 gradient-bg text-white font-medium py-3 px-4 rounded-xl transition duration-300 ease-in-out hover:shadow-lg hover:scale-105">
                        Confirmer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Variable globale pour stocker les informations du créneau sélectionné
        let selectedCreneau = null;

        // JavaScript pour gérer les clics sur les créneaux
        document.querySelectorAll('.creneau-disponible').forEach(button => {
            button.addEventListener('click', function() {
                const heureDebut = this.dataset.heureDebut;
                const heureFin = this.dataset.heureFin;
                const date = this.dataset.date;
                const terrainId = this.dataset.terrainId;
                const prixHeure = {{ $terrain->prix_heure }};

                // Stocker les informations du créneau sélectionné
                selectedCreneau = {
                    heureDebut: heureDebut,
                    heureFin: heureFin,
                    date: date,
                    terrainId: terrainId
                };

                // Formater la date
                const dateObj = new Date(date);
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const dateFormatted = dateObj.toLocaleDateString('fr-FR', options);

                // Mettre à jour le modal
                document.getElementById('modal-date').textContent = dateFormatted;
                document.getElementById('modal-date').dataset.originalDate = date;
                document.getElementById('modal-time').textContent = `${heureDebut} - ${heureFin}`;
                document.getElementById('modal-price').textContent = `${prixHeure.toFixed(2)}€`;

                // Afficher le modal
                document.getElementById('reservation-modal').classList.remove('hidden');
            });
        });

        // Fermer le modal
        document.getElementById('modal-close')?.addEventListener('click', function() {
            document.getElementById('reservation-modal').classList.add('hidden');
        });

        document.getElementById('modal-cancel')?.addEventListener('click', function() {
            document.getElementById('reservation-modal').classList.add('hidden');
        });

        // Confirmer la réservation
        document.getElementById('modal-confirm')?.addEventListener('click', function() {
            if (!selectedCreneau) {
                alert('Erreur: Aucun créneau sélectionné');
                return;
            }

            // Rediriger vers la page de création de réservation avec les paramètres
            const url = '{{ route("reservations.create") }}?' +
                'terrain_id={{ $terrain->id }}&' +
                'date=' + encodeURIComponent(selectedCreneau.date) + '&' +
                'heure_debut=' + encodeURIComponent(selectedCreneau.heureDebut);

            window.location.href = url;
        });

        // Fermer le modal en cliquant en dehors
        document.getElementById('reservation-modal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>

    <!-- Modal pour afficher l'image du terrain -->
    <div id="image-modal" class="fixed inset-0 bg-black bg-opacity-75 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl max-h-screen overflow-hidden">
                <!-- Header du modal -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900" id="image-modal-title">Image du terrain</h3>
                    <button id="image-modal-close" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Image -->
                <div class="relative">
                    <img id="image-modal-img" src="" alt="" class="w-full max-h-96 md:max-h-[600px] object-contain">
                </div>
            </div>
        </div>
    </div>

    <script>
        console.log('Script loaded');

        // Attendre que le DOM soit chargé
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, attaching event listeners');

            // Fonction pour ouvrir le modal d'image
            window.openImageModal = function(imageSrc, terrainName) {
                console.log('Opening image modal with:', imageSrc, terrainName);

                const modal = document.getElementById('image-modal');
                const modalImg = document.getElementById('image-modal-img');
                const modalTitle = document.getElementById('image-modal-title');

                console.log('Modal element found:', !!modal);
                console.log('Modal img element found:', !!modalImg);
                console.log('Modal title element found:', !!modalTitle);

                if (!modal || !modalImg || !modalTitle) {
                    console.error('Modal elements not found!');
                    alert('Erreur: Le modal d\'image n\'est pas disponible.');
                    return;
                }

                // Afficher le modal d'abord
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling

                // Puis charger l'image
                modalImg.onload = function() {
                    console.log('Image loaded successfully');
                };

                modalImg.onerror = function() {
                    console.error('Image failed to load:', imageSrc);
                    alert('Erreur: Impossible de charger l\'image.');
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                };

                modalImg.src = imageSrc;
                modalImg.alt = 'Image de ' + terrainName;
                modalTitle.textContent = 'Image de ' + terrainName;

                console.log('Modal opened successfully');
            };

            // Fermer le modal d'image
            const closeBtn = document.getElementById('image-modal-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    console.log('Closing image modal via close button');
                    document.getElementById('image-modal').classList.add('hidden');
                    document.body.style.overflow = 'auto';
                });
            }

            // Fermer le modal d'image en cliquant en dehors
            const modal = document.getElementById('image-modal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        console.log('Closing image modal via outside click');
                        this.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }
                });
            }

            // Fermer avec la touche Échap
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                    console.log('Closing image modal via Escape key');
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            });

            // Attacher l'event listener au bouton d'agrandissement
            const enlargeBtn = document.getElementById('enlarge-image-btn');
            if (enlargeBtn) {
                enlargeBtn.addEventListener('click', function() {
                    console.log('Enlarge image button clicked');
                    window.openImageModal('{{ $terrain->image_url }}', '{{ $terrain->nom }}');
                });
                console.log('Enlarge image button event listener attached');
            } else {
                console.error('Enlarge image button not found');
            }

            console.log('All event listeners attached successfully');
        });
    </script>
@endsection
