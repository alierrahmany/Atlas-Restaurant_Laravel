@extends('layouts.app')

@section('title', 'Modifier mon profil')

@section('content')
<div class="container py-4">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-primary mb-0">
                <i class="fas fa-user-edit me-2"></i>Modifier mon profil
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modification</li>
                </ol>
            </nav>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">
                <i class="fas fa-user-cog me-2 text-primary"></i>Informations du profil
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="nom" class="form-label fw-bold">Nom</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                               id="nom" name="nom" value="{{ old('nom', $user->nom) }}" required>
                        @error('nom')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="prenom" class="form-label fw-bold">Prénom</label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                               id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}" required>
                        @error('prenom')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="photo" class="form-label fw-bold">Photo de profil</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                           id="photo" name="photo" accept="image/*">
                    @error('photo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    
                    @if($user->photo)
                        <div class="mt-3 d-flex align-items-start">
                            <img src="{{ asset('storage/' . $user->photo) }}" 
                                 alt="Photo de profil actuelle" 
                                 class="img-thumbnail rounded-circle me-4" 
                                 width="120">
                            <div class="flex-grow-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           role="switch"
                                           id="remove_photo" 
                                           name="remove_photo"
                                           value="1">
                                    <label class="form-check-label" for="remove_photo">
                                        Supprimer la photo actuelle
                                    </label>
                                </div>
                                <small class="text-muted d-block mt-1">Cochez cette case si vous souhaitez supprimer votre photo de profil actuelle.</small>
                            </div>
                        </div>
                    @endif
                </div>            
                <div class="d-flex justify-content-end border-top pt-4">
                    <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary me-3 px-4">
                        <i class="fas fa-times me-1"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection