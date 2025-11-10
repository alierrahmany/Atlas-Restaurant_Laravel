<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $todayReservations = Reservation::where('matricule', $user->matricule)
            ->whereDate('date_reservation', today())
            ->first();

        return view('user.dashboard', compact('todayReservations'));
    }

    /**
     * Afficher les annulations du personnel
     */
    public function annulations()
    {
        $annulations = Auth::user()->reservations()
            ->where('annulation', true)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('user.annulations.index', compact('annulations'));
    }
}

