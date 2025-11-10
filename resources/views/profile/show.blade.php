@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="container py-4">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-primary mb-0">
                <i class="fas fa-user-circle me-2"></i>Mon profil
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>
        </div>
        
    </div>

    <div class="row">
        <!-- Informations personnelles -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2 text-primary"></i>Informations personnelles
                    </h5>
                </div>
                <div class="card-body pt-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 py-3 d-flex align-items-center">
                            <div class="me-3 text-muted">
                                <i class="fas fa-id-card fa-fw"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-muted">Matricule</h6>
                                <p class="mb-0 fw-bold">{{ $user->matricule }}</p>
                            </div>
                        </div>
                        <div class="list-group-item border-0 py-3 d-flex align-items-center">
                            <div class="me-3 text-muted">
                                <i class="fas fa-user fa-fw"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-muted">Nom</h6>
                                <p class="mb-0 fw-bold">{{ $user->nom }}</p>
                            </div>
                        </div>
                        <div class="list-group-item border-0 py-3 d-flex align-items-center">
                            <div class="me-3 text-muted">
                                <i class="fas fa-user-tag fa-fw"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-muted">Prénom</h6>
                                <p class="mb-0 fw-bold">{{ $user->prenom }}</p>
                            </div>
                        </div>
                        <div class="list-group-item border-0 py-3 d-flex align-items-center">
                            <div class="me-3 text-muted">
                                <i class="fas fa-envelope fa-fw"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 text-muted">Email</h6>
                                <p class="mb-0 fw-bold">{{ $user->email }}</p>
                            </div>
                        </div>
                        @if($user->photo)
<div class="list-group-item border-0 py-3 d-flex align-items-center">
    <div class="me-3 text-muted">
        <i class="fas fa-camera fa-fw"></i>
    </div>
    <div class="flex-grow-1">
        <h6 class="mb-0 text-muted">Photo</h6>
        @auth
    @if(auth()->user()->photo)
        <div class="d-none">
            Photo path: {{ auth()->user()->photo }}<br>
            Storage exists: {{ Storage::disk('public')->exists(auth()->user()->photo) ? 'Yes' : 'No' }}<br>
            Asset URL: {{ asset('storage/' . auth()->user()->photo) }}
        </div>
    @endif
@endauth
    </div>
</div>
                        @endif
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="fas fa-edit me-1"></i> Modifier
                </a>
            </div>
        </div>

        <!-- Réservations -->
       
@if(auth()->user()->isPersonnel())
<div class="col-lg-6">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0">
                <i class="fas fa-calendar-alt me-2 text-primary"></i>Mes réservations ce mois-ci
            </h5>
        </div>
        <div class="card-body pt-0">
            @if($currentMonthReservations->isEmpty())
                <div class="text-center py-4">
                    <i class="far fa-calendar-times fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Aucune réservation ce mois-ci</h5>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th class="text-center">Matin</th>
                                <th class="text-center">Midi</th>
                                <th class="text-center">Soir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($currentMonthReservations as $reservation)
                                <tr>
                                    <td class="fw-bold">{{ $reservation->date_reservation->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        @if($reservation->petit_dejeuner)
                                            <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">
                                                <i class="fas fa-check me-1"></i>
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary py-2 px-3">
                                                <i class="fas fa-times me-1"></i>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($reservation->dejeuner)
                                            <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">
                                                <i class="fas fa-check me-1"></i>
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary py-2 px-3">
                                                <i class="fas fa-times me-1"></i>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($reservation->diner)
                                            <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">
                                                <i class="fas fa-check me-1"></i>
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary py-2 px-3">
                                                <i class="fas fa-times me-1"></i>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endif
    </div>
</div>
@endsection