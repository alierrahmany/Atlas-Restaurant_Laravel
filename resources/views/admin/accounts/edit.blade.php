@extends('layouts.app')

@section('title', 'Modifier un compte')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-user-edit text-primary"></i> Modifier le compte de {{ $compte->prenom }} {{ $compte->nom }}
    </h1>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title mb-0">
            <i class="fas fa-user-cog"></i> Informations du compte
        </h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.accounts.update', $compte->matricule) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" 
                               value="{{ old('nom', $compte->nom) }}" placeholder="Nom" required>
                        <label for="nom">
                            <i class="fas fa-user-tag me-1"></i> Nom
                        </label>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" 
                               value="{{ old('prenom', $compte->prenom) }}" placeholder="Prénom" required>
                        <label for="prenom">
                            <i class="fas fa-user me-1"></i> Prénom
                        </label>
                        @error('prenom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" 
                               value="{{ old('email', $compte->email) }}" placeholder="Email" required>
                        <label for="email">
                            <i class="fas fa-envelope me-1"></i> Email
                        </label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select @error('type_compte') is-invalid @enderror" id="type_compte" name="type_compte" required>
                            <option value="personnel" {{ old('type_compte', $compte->type_compte) == 'personnel' ? 'selected' : '' }}>
                                Personnel
                            </option>
                            <option value="admin" {{ old('type_compte', $compte->type_compte) == 'admin' ? 'selected' : '' }}>
                                Administrateur
                            </option>
                        </select>
                        <label for="type_compte">
                            <i class="fas fa-user-shield me-1"></i> Type de compte
                        </label>
                        @error('type_compte')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="mb-3">
                        <label for="photo" class="form-label">
                            <i class="fas fa-camera me-1"></i> Photo de profil
                        </label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($compte->photo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $compte->photo) }}" alt="Photo actuelle" class="img-thumbnail rounded-circle" width="100">
                                <small class="d-block text-muted mt-1">Photo actuelle</small>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i> Mettre à jour
                    </button>
                    <a href="{{ route('admin.accounts') }}" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-times me-2"></i> Annuler
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection