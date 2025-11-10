@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 to-indigo-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <!-- Carte avec effet glassmorphisme -->
        <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-xl overflow-hidden border border-white/20">
            <div class="p-8">
                <!-- Logo avec animation -->
                <div class="flex justify-center animate-bounce">
                    <div class="bg-white p-3 rounded-full shadow-lg">
                        <img class="h-12 w-auto" src="{{ asset('images/logo.png') }}" alt="Atlas Restaurant">
                    </div>
                </div>

                <h2 class="mt-6 text-center text-3xl font-bold text-white">
                    Créer un compte
                </h2>
                <p class="mt-2 text-center text-sm text-white/80">
                    Rejoignez notre équipe
                </p>

                <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="space-y-4">
                        <!-- Nom -->
                        <div>
                            <label for="nom" class="sr-only">Nom</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-white/50"></i>
                                </div>
                                <input id="nom" name="nom" type="text" autocomplete="family-name" required
                                       class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition duration-300 @error('nom') border-red-400 @enderror"
                                       placeholder="Nom" value="{{ old('nom') }}">
                            </div>
                            @error('nom')
                                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prénom -->
                        <div>
                            <label for="prenom" class="sr-only">Prénom</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-circle text-white/50"></i>
                                </div>
                                <input id="prenom" name="prenom" type="text" autocomplete="given-name" required
                                       class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition duration-300 @error('prenom') border-red-400 @enderror"
                                       placeholder="Prénom" value="{{ old('prenom') }}">
                            </div>
                            @error('prenom')
                                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-white/50"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                       class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition duration-300 @error('email') border-red-400 @enderror"
                                       placeholder="Adresse email" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div>
                            <label for="motdepasse" class="sr-only">Mot de passe</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-white/50"></i>
                                </div>
                                <input id="motdepasse" name="motdepasse" type="password" autocomplete="new-password" required
                                       class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition duration-300 @error('motdepasse') border-red-400 @enderror"
                                       placeholder="Mot de passe">
                            </div>
                            @error('motdepasse')
                                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div>
                            <label for="motdepasse_confirmation" class="sr-only">Confirmer le mot de passe</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-white/50"></i>
                                </div>
                                <input id="motdepasse_confirmation" name="motdepasse_confirmation" type="password" autocomplete="new-password" required
                                       class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition duration-300"
                                       placeholder="Confirmer le mot de passe">
                            </div>
                        </div>
                    </div>

                    <!-- Bouton d'inscription -->
                    <div>
                        <button type="submit"
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300 shadow-lg transform hover:-translate-y-1 transition duration-300">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200 transition duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Créer mon compte
                        </button>
                    </div>

                    <!-- Lien vers connexion -->
                    <div class="text-center">
                        <p class="text-sm text-white/80">
                            Déjà un compte ?
                            <a href="{{ route('login') }}" class="font-medium text-blue-300 hover:text-blue-200 transition duration-300">
                                Se connecter
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Footer de la carte -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-white/60">
                        © 2023 Atlas Restaurant. Tous droits réservés.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection