<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class StatistiqueController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');
        
        $statsByMeal = [
            'petit_dejeuner' => Reservation::where('petit_dejeuner', true)
                ->where('annulation', false)
                ->whereDate('date_reservation', '>=', $today)
                ->count(),
            'dejeuner' => Reservation::where('dejeuner', true)
                ->where('annulation', false)
                ->whereDate('date_reservation', '>=', $today)
                ->count(),
            'diner' => Reservation::where('diner', true)
                ->where('annulation', false)
                ->whereDate('date_reservation', '>=', $today)
                ->count(),
        ];

        return view('statistiques.index', compact('statsByMeal'));
    }

    public function byDay(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));
        
        $stats = [
            'petit_dejeuner' => Reservation::where('petit_dejeuner', true)
                ->where('annulation', false)
                ->whereDate('date_reservation', $date)
                ->count(),
            'dejeuner' => Reservation::where('dejeuner', true)
                ->where('annulation', false)
                ->whereDate('date_reservation', $date)
                ->count(),
            'diner' => Reservation::where('diner', true)
                ->where('annulation', false)
                ->whereDate('date_reservation', $date)
                ->count(),
        ];

        return view('statistiques.by_day', compact('stats', 'date'));
    }

    public function byMonth(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        
        $stats = [
            'petit_dejeuner' => Reservation::where('petit_dejeuner', true)
                ->where('annulation', false)
                ->whereMonth('date_reservation', $month)
                ->whereYear('date_reservation', $year)
                ->count(),
            'dejeuner' => Reservation::where('dejeuner', true)
                ->where('annulation', false)
                ->whereMonth('date_reservation', $month)
                ->whereYear('date_reservation', $year)
                ->count(),
            'diner' => Reservation::where('diner', true)
                ->where('annulation', false)
                ->whereMonth('date_reservation', $month)
                ->whereYear('date_reservation', $year)
                ->count(),
        ];

        return view('statistiques.by_month', compact('stats', 'month', 'year'));
    }
}

