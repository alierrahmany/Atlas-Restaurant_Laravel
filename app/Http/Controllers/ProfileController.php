<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Compte;
use App\Models\Reservation;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        
        try {
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            
            $currentMonthReservations = Reservation::where('matricule', $user->matricule)
                ->where('annulation', false)
                ->whereMonth('date_reservation', $currentMonth)
                ->whereYear('date_reservation', $currentYear)
                ->orderBy('date_reservation')
                ->get();
        } catch (\Exception $e) {
            \Log::error('Error fetching reservations: ' . $e->getMessage());
            $currentMonthReservations = collect();
        }

        return view('profile.show', compact('user', 'currentMonthReservations'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        $validated = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:comptes,email,' . $user->matricule . ',matricule',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_photo' => 'nullable|boolean',
        ]);
    
        // Handle photo removal
        if ($request->has('remove_photo') && $request->remove_photo) {
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('profile-photos', 'public');
                $validated['photo'] = $path; // Doit être 'profile-photos/filename.jpg'
            }
            $validated['photo'] = null;
        }
        // Handle new photo upload
        elseif ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            
            // Store new photo
            $path = $request->file('photo')->store('profile-photos', 'public');
            $validated['photo'] = $path;
        } else {
            // Keep the old photo if no changes were made
            $validated['photo'] = $user->photo;
        }
    
        $user->update($validated);
    
        return redirect()->route('profile.show')
            ->with('success', 'Profil mis à jour avec succès.');
    }
}
