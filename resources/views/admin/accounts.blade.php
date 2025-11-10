@extends('layouts.app')

@section('title', 'Gestion des comptes - Administrateurs')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-shield-alt me-2"></i>Gestion des comptes (Admins)
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.accounts.create') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-plus-circle me-1"></i>Créer un compte admin
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Type</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Filtrer seulement les comptes admin
                $admins = $comptes->filter(fn($compte) => $compte->isAdmin());
            @endphp

            @forelse($admins as $compte)
                <tr>
                    <td class="fw-bold">{{ $compte->matricule }}</td>
                    <td>{{ $compte->nom }}</td>
                    <td>{{ $compte->prenom }}</td>
                    <td>
                        <a href="mailto:{{ $compte->email }}" class="text-decoration-none">
                            {{ $compte->email }}
                        </a>
                    </td>
                    <td>
                        <span class="badge bg-danger rounded-pill">
                            <i class="fas fa-shield-alt me-1"></i>Admin
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('admin.accounts.edit', $compte->matricule) }}" 
                               class="btn btn-outline-primary" 
                               title="Modifier"
                               data-bs-toggle="tooltip">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.accounts.destroy', $compte->matricule) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-outline-danger" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet admin ?')"
                                        title="Supprimer"
                                        data-bs-toggle="tooltip">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <i class="fas fa-user-shield fa-2x mb-3 text-muted"></i>
                        <p class="text-muted">Aucun administrateur trouvé</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    // Enable Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })
</script>
@endpush
