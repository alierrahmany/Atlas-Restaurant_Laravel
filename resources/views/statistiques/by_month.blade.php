@extends('layouts.app')

@section('title', 'Statistiques par mois')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-calendar-alt"></i> Statistiques par mois
    </h1>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-header bg-light">
        <i class="fas fa-filter"></i> Filtrer par mois
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('statistiques.month') }}">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        <select class="form-select" name="month">
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar-year"></i></span>
                        <select class="form-select" name="year">
                            @for($i = date('Y') - 2; $i <= date('Y') + 1; $i++)
                                <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Filtrer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3 shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-coffee"></i> Petit-déjeuner</span>
                <span class="badge bg-light text-dark fs-6">{{ $stats['petit_dejeuner'] }}</span>
            </div>
            <div class="card-body">
                <h5 class="card-title display-6 text-center">{{ $stats['petit_dejeuner'] }}</h5>
                <p class="card-text text-center">
                    <small>Réservations pour {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}</small>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3 shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-utensils"></i> Déjeuner</span>
                <span class="badge bg-light text-dark fs-6">{{ $stats['dejeuner'] }}</span>
            </div>
            <div class="card-body">
                <h5 class="card-title display-6 text-center">{{ $stats['dejeuner'] }}</h5>
                <p class="card-text text-center">
                    <small>Réservations pour {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}</small>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3 shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-moon"></i> Dîner</span>
                <span class="badge bg-light text-dark fs-6">{{ $stats['diner'] }}</span>
            </div>
            <div class="card-body">
                <h5 class="card-title display-6 text-center">{{ $stats['diner'] }}</h5>
                <p class="card-text text-center">
                    <small>Réservations pour {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}</small>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection