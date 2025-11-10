<!-- resources/views/reservations/create.blade.php -->
@extends('layouts.app')

@section('title', 'Nouvelle réservation')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-plus-circle me-2"></i>Nouvelle réservation
    </h1>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf
            <div class="mb-3">
                <label for="date_reservation" class="form-label">
                    <i class="far fa-calendar-alt me-1"></i>Date de réservation
                </label>
                <input type="date" class="form-control @error('date_reservation') is-invalid @enderror" id="date_reservation" name="date_reservation" min="{{ date('Y-m-d') }}" required>
                @error('date_reservation')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-utensils me-1"></i>Repas
                </label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="petit_dejeuner" name="petit_dejeuner" value="1">
                    <label class="form-check-label" for="petit_dejeuner">
                        <i class="fas fa-coffee me-1"></i>Petit-déjeuner
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="dejeuner" name="dejeuner" value="1">
                    <label class="form-check-label" for="dejeuner">
                        <i class="fas fa-utensils me-1"></i>Déjeuner
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="diner" name="diner" value="1">
                    <label class="form-check-label" for="diner">
                        <i class="fas fa-moon me-1"></i>Dîner
                    </label>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary me-md-2">
                    <i class="fas fa-save me-1"></i>Enregistrer
                </button>
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i>Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection