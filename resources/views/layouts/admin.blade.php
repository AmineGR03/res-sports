<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration - Res-Sports')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }
        .gradient-bg-alt {
            background: linear-gradient(135deg, #f87171 0%, #fca5a5 100%);
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        .stats-gradient {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(185, 28, 28, 0.1) 100%);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }
        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <div class="gradient-bg rounded-lg p-2 mr-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold gradient-bg bg-clip-text text-transparent">
                            Administration
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-2 ml-10">
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-link text-gray-700 hover:text-white hover:bg-red-600 px-4 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center space-x-2 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white shadow-lg' : 'bg-white/10 backdrop-blur-sm' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('admin.users') }}"
                           class="nav-link text-gray-700 hover:text-white hover:bg-red-600 px-4 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center space-x-2 {{ request()->routeIs('admin.users.*') ? 'bg-red-600 text-white shadow-lg' : 'bg-white/10 backdrop-blur-sm' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <span>Utilisateurs</span>
                        </a>

                        <a href="{{ route('admin.terrains') }}"
                           class="nav-link text-gray-700 hover:text-white hover:bg-red-600 px-4 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center space-x-2 {{ request()->routeIs('admin.terrains.*') ? 'bg-red-600 text-white shadow-lg' : 'bg-white/10 backdrop-blur-sm' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span>Terrains</span>
                        </a>

                        <a href="{{ route('admin.equipements') }}"
                           class="nav-link text-gray-700 hover:text-white hover:bg-red-600 px-4 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center space-x-2 {{ request()->routeIs('admin.equipements.*') ? 'bg-red-600 text-white shadow-lg' : 'bg-white/10 backdrop-blur-sm' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span>Équipements</span>
                        </a>

                        <a href="{{ route('admin.reservations') }}"
                           class="nav-link text-gray-700 hover:text-white hover:bg-red-600 px-4 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center space-x-2 {{ request()->routeIs('admin.reservations.*') ? 'bg-red-600 text-white shadow-lg' : 'bg-white/10 backdrop-blur-sm' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Réservations</span>
                        </a>
                    </div>
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-700">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Admin: {{ Auth::user()->name }}</span>
                        </div>

                        <!-- Return to main site -->
                        <a href="{{ route('dashboard') }}"
                           class="text-indigo-600 hover:text-indigo-700 px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out flex items-center border border-indigo-200 hover:bg-indigo-50">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Site principal
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700" id="mobile-menu-button">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                    <a href="{{ route('admin.dashboard') }}"
                       class="text-gray-600 hover:text-red-600 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.dashboard') ? 'text-red-600 bg-red-50' : '' }}">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.users') }}"
                       class="text-gray-600 hover:text-red-600 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.users.*') ? 'text-red-600 bg-red-50' : '' }}">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Utilisateurs
                    </a>

                    <a href="{{ route('admin.terrains') }}"
                       class="text-gray-600 hover:text-red-600 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.terrains.*') ? 'text-red-600 bg-red-50' : '' }}">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Terrains
                    </a>

                    <a href="{{ route('admin.equipements') }}"
                       class="text-gray-600 hover:text-red-600 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.equipements.*') ? 'text-red-600 bg-red-50' : '' }}">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Équipements
                    </a>

                    <a href="{{ route('admin.reservations') }}"
                       class="text-gray-600 hover:text-red-600 block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.reservations.*') ? 'text-red-600 bg-red-50' : '' }}">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Réservations
                    </a>
                </div>
            </div>
        </nav>

        <!-- Page Header -->
        @hasSection('header')
            <header class="gradient-bg shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Main Content -->
        <main class="flex-1">
            @yield('admin-content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-16">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Administration Res-Sports</h3>
                        <p class="text-gray-600 text-sm">
                            Panel d'administration de la plateforme de réservation de terrains sportifs.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-md font-semibold text-gray-900 mb-4">Navigation rapide</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-red-600">Dashboard</a></li>
                            <li><a href="{{ route('admin.users') }}" class="hover:text-red-600">Utilisateurs</a></li>
                            <li><a href="{{ route('admin.terrains') }}" class="hover:text-red-600">Terrains</a></li>
                            <li><a href="{{ route('admin.reservations') }}" class="hover:text-red-600">Réservations</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-md font-semibold text-gray-900 mb-4">Support</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li><a href="#" class="hover:text-red-600">Documentation</a></li>
                            <li><a href="#" class="hover:text-red-600">Support technique</a></li>
                            <li><a href="#" class="hover:text-red-600">Rapports de bug</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-200 mt-8 pt-8 text-center text-sm text-gray-600">
                    <p>&copy; {{ date('Y') }} Res-Sports - Panel d'administration. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
