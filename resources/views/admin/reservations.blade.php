@extends('layouts.app')

@section('title', 'Gestion des réservations')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des réservations</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Personnel</th>
                <th class="text-center">Petit-déjeuner</th>
                <th class="text-center">Déjeuner</th>
                <th class="text-center">Dîner</th>
                <th class="text-center">Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->date_reservation->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-circle fa-lg me-2 text-primary"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                {{ $reservation->compte->prenom }} {{ $reservation->compte->nom }}
                                <small class="d-block text-muted">{{ $reservation->compte->matricule }}</small>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        @if($reservation->petit_dejeuner)
                            <i class="fas fa-check-circle text-success fs-5"></i>
                        @else
                            <i class="fas fa-times-circle text-secondary fs-5"></i>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($reservation->dejeuner)
                            <i class="fas fa-check-circle text-success fs-5"></i>
                        @else
                            <i class="fas fa-times-circle text-secondary fs-5"></i>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($reservation->diner)
                            <i class="fas fa-check-circle text-success fs-5"></i>
                        @else
                            <i class="fas fa-times-circle text-secondary fs-5"></i>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($reservation->annulation)
                            <span class="badge bg-danger rounded-pill">
                                <i class="fas fa-ban me-1"></i> Annulée
                            </span>
                        @else
                            <span class="badge bg-success rounded-pill">
                                <i class="fas fa-check me-1"></i> Active
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                        <p class="text-muted">Aucune réservation trouvée</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $reservations->links() }}
</div>
@endsection