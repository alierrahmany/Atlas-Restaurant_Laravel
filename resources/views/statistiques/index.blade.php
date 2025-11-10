<!-- resources/views/statistiques/index.blade.php -->
@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-chart-bar me-2"></i>Statistiques</h1>
</div>

<div class="card mb-4">
    <div class="card-header bg-white">
        <i class="fas fa-utensils me-2"></i>Statistiques par type de repas
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-coffee me-2"></i>Petit-déjeuner
                    </div>
                    <div class="card-body text-center">
                        <h2 class="card-title display-5">{{ $statsByMeal['petit_dejeuner'] }}</h2>
                        <p class="card-text">
                            <i class="far fa-calendar-check me-1"></i>Réservations futures
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-utensils me-2"></i>Déjeuner
                    </div>
                    <div class="card-body text-center">
                        <h2 class="card-title display-5">{{ $statsByMeal['dejeuner'] }}</h2>
                        <p class="card-text">
                            <i class="far fa-calendar-check me-1"></i>Réservations futures
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-moon me-2"></i>Dîner
                    </div>
                    <div class="card-body text-center">
                        <h2 class="card-title display-5">{{ $statsByMeal['diner'] }}</h2>
                        <p class="card-text">
                            <i class="far fa-calendar-check me-1"></i>Réservations futures
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white">
        <i class="fas fa-chart-pie me-2"></i>Autres statistiques
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-primary mb-3 h-100">
                    <div class="card-header bg-white text-primary">
                        <i class="fas fa-calendar-day me-2"></i>Par jour
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 120px;">
                        <a href="{{ route('statistiques.day') }}" class="btn btn-outline-primary">
                            <i class="fas fa-chart-line me-2"></i>Voir les statistiques
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-success h-100">
                    <div class="card-header bg-white text-success">
                        <i class="fas fa-calendar-alt me-2"></i>Par mois
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 120px;">
                        <a href="{{ route('statistiques.month') }}" class="btn btn-outline-success">
                            <i class="fas fa-chart-area me-2"></i>Voir les statistiques
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection