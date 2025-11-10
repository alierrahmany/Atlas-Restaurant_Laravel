<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Tableau de bord Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
    <h1 class="h3 mb-0 text-primary">
        <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
    </h1>
    <span class="badge bg-primary text-white">
        <i class="far fa-calendar-alt me-1"></i> {{ now()->format('d/m/Y') }}
    </span>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-start border-primary border-4 shadow-sm h-100">
            <div class="card-header bg-white d-flex align-items-center">
                <i class="fas fa-users me-2 text-primary"></i>
                <span class="fw-bold">Utilisateurs</span>
            </div>
            <div class="card-body text-center py-4">
                <h2 class="card-title text-primary mb-1">{{ $totalUsers }}</h2>
                <p class="card-text text-muted small">Nombre total de personnel</p>
                <div class="mt-3">
                    <i class="fas fa-user-plus fa-2x text-primary opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-start border-success border-4 shadow-sm h-100">
            <div class="card-header bg-white d-flex align-items-center">
                <i class="fas fa-calendar-check me-2 text-success"></i>
                <span class="fw-bold">Réservations</span>
            </div>
            <div class="card-body text-center py-4">
                <h2 class="card-title text-success mb-1">{{ $totalReservations }}</h2>
                <p class="card-text text-muted small">Nombre total de réservations</p>
                <div class="mt-3">
                    <i class="fas fa-list-alt fa-2x text-success opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-start border-info border-4 shadow-sm h-100">
            <div class="card-header bg-white d-flex align-items-center">
                <i class="fas fa-clock me-2 text-info"></i>
                <span class="fw-bold">Aujourd'hui</span>
            </div>
            <div class="card-body text-center py-4">
                <h2 class="card-title text-info mb-1">{{ $todayReservations }}</h2>
                <p class="card-text text-muted small">Réservations pour aujourd'hui</p>
                <div class="mt-3">
                    <i class="fas fa-sun fa-2x text-info opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection