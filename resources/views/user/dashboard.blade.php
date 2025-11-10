@extends('layouts.app')

@section('title', 'Tableau de bord Personnel')

@section('content')
<div class="container py-4">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <h1 class="h3 mb-0 text-primary">
            <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
        </h1>
        <span class="badge bg-light text-dark">
            <i class="far fa-calendar me-1"></i> {{ now()->format('d/m/Y') }}
        </span>
    </div>

    <!-- Réservations -->
    @if($todayReservations)
        <div class="alert alert-success border-start border-5 border-success bg-white shadow-sm">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                <div>
                    <h5 class="alert-heading mb-1">Réservations aujourd'hui</h5>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        @if($todayReservations->petit_dejeuner)
                            <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">
                                <i class="fas fa-coffee me-1"></i> Petit-déjeuner
                            </span>
                        @endif
                        @if($todayReservations->dejeuner)
                            <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">
                                <i class="fas fa-utensils me-1"></i> Déjeuner
                            </span>
                        @endif
                        @if($todayReservations->diner)
                            <span class="badge bg-success bg-opacity-10 text-success py-2 px-3">
                                <i class="fas fa-moon me-1"></i> Dîner
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning border-start border-5 border-warning bg-white shadow-sm">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle fa-2x text-warning me-3"></i>
                <div>
                    <h5 class="alert-heading mb-1">Aucune réservation aujourd'hui</h5>
                    <p class="mb-0">Vous n'avez pas de réservation pour aujourd'hui.</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection