@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-900 to-indigo-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <!-- Carte avec effet glassmorphisme -->
        <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-xl overflow-hidden border border-white/20">
            <div class="p-8">
                <!-- Logo à gauche -->
                <div class="flex items-center justify-start mb-6">
                    <div class="bg-white p-2 rounded-full shadow-lg">
                        <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="Atlas Restaurant">
                    </div>
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-white">Atlas Restaurant</h1>
                        <p class="text-xs text-white/70">Espace Personnel</p>
                    </div>
                </div>

                <h2 class="text-center text-2xl font-bold text-white mb-2">
                    Bienvenue
                </h2>
                <p class="text-center text-sm text-white/80 mb-8">
                    Connectez-vous à votre espace
                </p>

                <form class="space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Inputs avec effet néon au focus -->
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-white/50"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                       class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent transition duration-300 @error('email') border-red-400 @enderror"
                                       placeholder="Adresse email" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="motdepasse" class="sr-only">Mot de passe</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-white/50"></i>
                                </div>
                                <input id="motdepasse" name="motdepasse" type="password" autocomplete="current-password" required
                                       class="w-full pl-10 pr-3 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-300 focus:border-transparent transition duration-300 @error('motdepasse') border-red-400 @enderror"
                                       placeholder="Mot de passe">
                            </div>
                            @error('motdepasse')
                                <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                   class="h-4 w-4 text-purple-400 focus:ring-purple-300 border-white/30 rounded bg-white/10">
                            <label for="remember" class="ml-2 block text-sm text-white/80">
                                Se souvenir de moi
                            </label>
                        </div>
                    </div>

                    <!-- Bouton avec effet hover -->
                    <div>
                        <button type="submit"
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-purple-900 bg-white hover:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-300 shadow-lg transform hover:-translate-y-1 transition duration-300">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-purple-600 group-hover:text-purple-700 transition duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Connexion
                        </button>
                    </div>
                </form>

                <!-- Lien vers inscription -->
                <div class="text-center mt-6">
                    <p class="text-sm text-white/80">
                        Pas encore de compte ?
                        <a href="{{ route('register') }}" class="font-medium text-purple-300 hover:text-purple-200 transition duration-300">
                            Créer un compte
                        </a>
                    </p>
                </div>

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

@if(session('email') && session('motdepasse'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('email').value = "{{ session('email') }}";
        document.getElementById('motdepasse').value = "{{ session('motdepasse') }}";
        document.getElementById('remember').checked = true;
    });
</script>
@endif
@endsection