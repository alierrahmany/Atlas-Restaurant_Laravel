<!-- resources/views/reservations/index.blade.php -->
@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-calendar-alt me-2"></i>Mes réservations
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('reservations.create') }}" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-plus-circle me-1"></i> Nouvelle réservation
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><i class="far fa-calendar me-1"></i> Date</th>
                <th><i class="fas fa-coffee me-1"></i> Petit-déj.</th>
                <th><i class="fas fa-utensils me-1"></i> Déjeuner</th>
                <th><i class="fas fa-moon me-1"></i> Dîner</th>
                <th><i class="fas fa-cog me-1"></i> Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->date_reservation->format('d/m/Y') }}</td>
                    <td>
                        @if($reservation->petit_dejeuner)
                            <span class="badge bg-success"><i class="fas fa-check"></i> Oui</span>
                        @else
                            <span class="badge bg-secondary"><i class="fas fa-times"></i> Non</span>
                        @endif
                    </td>
                    <td>
                        @if($reservation->dejeuner)
                            <span class="badge bg-success"><i class="fas fa-check"></i> Oui</span>
                        @else
                            <span class="badge bg-secondary"><i class="fas fa-times"></i> Non</span>
                        @endif
                    </td>
                    <td>
                        @if($reservation->diner)
                            <span class="badge bg-success"><i class="fas fa-check"></i> Oui</span>
                        @else
                            <span class="badge bg-secondary"><i class="fas fa-times"></i> Non</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation?')">
                                <i class="fas fa-times-circle me-1"></i> Annuler
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="fas fa-calendar-times fa-2x mb-2"></i>
                        <p>Aucune réservation trouvée</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection