<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atlas Restaurant - @yield('title')</title>
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- CDN Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Configuration Tailwind personnalisée -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            900: '#4c1d95',
                            800: '#5b21b6',
                            700: '#6d28d9',
                            600: '#7c3aed',
                            500: '#8b5cf6',
                        },
                        dark: {
                            900: '#0f172a',
                            800: '#1e293b',
                            700: '#334155',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-shadow {
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }
        .menu-item-active {
            background: linear-gradient(135deg, #ede9fe 0%, #f3f4f6 100%);
            border-right: 3px solid #7c3aed;
        }
        .menu-item-hover:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            transform: translateX(2px);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">
    @if(!Route::is('login') && !Route::is('register'))
    <!-- Navigation principale - FIXED POSITIONING -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-primary-800 to-primary-600 shadow-lg">
        <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
            <!-- Logo - Left side -->
            <div class="flex items-center">
                <a href="#" class="flex items-center">
                    <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="Atlas Restaurant">
                    <span class="ml-2 text-white font-semibold text-lg">Atlas Restaurant</span>
                </a>
            </div>

            <!-- Menu utilisateur - Right side -->
            <div class="flex items-center" x-data="{ open: false }">
                @auth
                <div class="relative">
                    <div>
                        <button @click="open = !open" type="button" class="flex items-center max-w-xs text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-white" id="user-menu-button">
                            <span class="text-white mr-2">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</span>
                            @if(auth()->user()->photo)
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Photo de profil">
                            @else
                                <div class="h-8 w-8 rounded-full bg-primary-400 flex items-center justify-center text-white font-medium">
                                    {{ strtoupper(substr(auth()->user()->prenom, 0, 1)) }}
                                </div>
                            @endif
                        </button>
                    </div>

                    <!-- Menu dropdown -->
                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <i class="fas fa-user mr-2"></i> Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" role="none">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-white text-primary-700 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">Inscription</a>
                </div>
                @endauth
            </div>
        </div>
    </nav>
    @endif

    <!-- Contenu principal -->
    <div class="@if(!Route::is('login') && !Route::is('register')) flex pt-16 @endif">
        @auth
        @if(!Route::is('login') && !Route::is('register'))
        <!-- Sidebar - PERFECTED DESIGN -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 border-r border-gray-200 bg-white sidebar-shadow">
                

                <div class="flex-1 flex flex-col pt-4 pb-4 overflow-y-auto">
                    <nav class="flex-1 px-3 space-y-1">
                        @if(auth()->user()->isAdmin())
                            <!-- Menu Admin -->
                            <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 @if(Route::is('admin.dashboard')) menu-item-active text-primary-800 @else text-gray-600 menu-item-hover @endif">
                                <i class="fas fa-tachometer-alt mr-3 flex-shrink-0 @if(Route::is('admin.dashboard')) text-primary-600 @else text-gray-400 group-hover:text-primary-500 @endif text-base"></i>
                                Tableau de bord
                            </a>
                            <a href="{{ route('admin.accounts') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 @if(Route::is('admin.accounts*')) menu-item-active text-primary-800 @else text-gray-600 menu-item-hover @endif">
                                <i class="fas fa-users mr-3 flex-shrink-0 @if(Route::is('admin.accounts*')) text-primary-600 @else text-gray-400 group-hover:text-primary-500 @endif text-base"></i>
                                Comptes
                            </a>
                            <a href="{{ route('admin.reservations') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 @if(Route::is('admin.reservations')) menu-item-active text-primary-800 @else text-gray-600 menu-item-hover @endif">
                                <i class="fas fa-calendar-alt mr-3 flex-shrink-0 @if(Route::is('admin.reservations')) text-primary-600 @else text-gray-400 group-hover:text-primary-500 @endif text-base"></i>
                                Réservations
                            </a>
                            
                            <a href="{{ route('statistiques.index') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 @if(Route::is('statistiques*')) menu-item-active text-primary-800 @else text-gray-600 menu-item-hover @endif">
                                <i class="fas fa-chart-bar mr-3 flex-shrink-0 @if(Route::is('statistiques*')) text-primary-600 @else text-gray-400 group-hover:text-primary-500 @endif text-base"></i>
                                Statistiques
                            </a>
                        @else
                            <!-- Menu Utilisateur -->
                            <a href="{{ route('user.dashboard') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 @if(Route::is('user.dashboard')) menu-item-active text-primary-800 @else text-gray-600 menu-item-hover @endif">
                                <i class="fas fa-tachometer-alt mr-3 flex-shrink-0 @if(Route::is('user.dashboard')) text-primary-600 @else text-gray-400 group-hover:text-primary-500 @endif text-base"></i>
                                Tableau de bord
                            </a>
                            <a href="{{ route('profile.show') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 @if(Route::is('profile*')) menu-item-active text-primary-800 @else text-gray-600 menu-item-hover @endif">
                                <i class="fas fa-user mr-3 flex-shrink-0 @if(Route::is('profile*')) text-primary-600 @else text-gray-400 group-hover:text-primary-500 @endif text-base"></i>
                                Mon profil
                            </a>
                            <a href="{{ route('reservations.index') }}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 @if(Route::is('reservations.index')) menu-item-active text-primary-800 @else text-gray-600 menu-item-hover @endif">
                                <i class="fas fa-calendar-alt mr-3 flex-shrink-0 @if(Route::is('reservations.index')) text-primary-600 @else text-gray-400 group-hover:text-primary-500 @endif text-base"></i>
                                Mes réservations
                            </a>
                        @endif
                    </nav>

                   
                </div>
            </div>
        </div>
        @endif
        @endauth

        <!-- Contenu principal -->
        <main class="@if(!Route::is('login') && !Route::is('register')) flex-1 @else w-full @endif">
            @if(!Route::is('login') && !Route::is('register'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @else
            <div class="w-full">
            @endif
                <!-- Messages flash -->
                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Alpine.js pour les interactions -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @stack('scripts')
</body>
</html>