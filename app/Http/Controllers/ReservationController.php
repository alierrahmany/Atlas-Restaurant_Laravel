<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $reservations = Reservation::where('matricule', $user->matricule)
            ->where('annulation', false)
            ->orderBy('date_reservation', 'desc')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_reservation' => 'required|date|after_or_equal:today',
            'petit_dejeuner' => 'sometimes|boolean',
            'dejeuner' => 'sometimes|boolean',
            'diner' => 'sometimes|boolean',
        ]);

        $existing = Reservation::where('matricule', auth()->user()->matricule)
            ->whereDate('date_reservation', $validated['date_reservation'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Vous avez déjà une réservation pour cette date.');
        }

        $reservation = new Reservation($validated);
        $reservation->matricule = auth()->user()->matricule;
        $reservation->save();

        return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès.');
    }

    public function cancel($id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('matricule', auth()->user()->matricule)
            ->firstOrFail();

        $reservation->annulation = true;
        $reservation->save();

        return back()->with('success', 'Réservation annulée avec succès.');
    }

    public function adminIndex()
    {
        $reservations = Reservation::with('compte')
            ->orderBy('date_reservation', 'desc')
            ->paginate(10);

        return view('admin.reservations', compact('reservations'));
    }
}

