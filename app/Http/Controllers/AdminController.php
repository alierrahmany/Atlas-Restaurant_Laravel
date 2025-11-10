<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Reservation;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = Compte::where('type_compte', 'personnel')->count();
        $totalReservations = Reservation::count();
        $todayReservations = Reservation::whereDate('date_reservation', today())->count();

        return view('admin.dashboard', compact('totalUsers', 'totalReservations', 'todayReservations'));
    }

    public function manageAccounts()
    {
        $comptes = Compte::all();
        return view('admin.accounts', compact('comptes'));
    }

    public function createAccount()
    {
        return view('admin.accounts.create');
    }

    public function storeAccount(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:comptes',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type_compte' => 'required|in:admin,personnel',
        ]);

        // Generate a random password
        $password = Str::random(10);
        
        // Create the account
        $compte = new Compte();
        $compte->matricule = 'EMP' . strtoupper(Str::random(6));
        $compte->login = strtolower($validated['prenom'][0] . $validated['nom']);
        $compte->motdepasse = $password; // In a real app, you would hash this
        $compte->nom = $validated['nom'];
        $compte->prenom = $validated['prenom'];
        $compte->email = $validated['email'];
        $compte->type_compte = $validated['type_compte'];

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile-photos', 'public');
            $compte->photo = $path;
        }

        $compte->save();

        // In a real app, you would send the password to the user via email
        return redirect()->route('admin.accounts')
            ->with('success', 'Compte créé avec succès. Login: ' . $compte->login . ' Mot de passe: ' . $password);
    }

    public function editAccount($matricule)
    {
        $compte = Compte::findOrFail($matricule);
        return view('admin.accounts.edit', compact('compte'));
    }

    public function updateAccount(Request $request, $matricule)
    {
        $compte = Compte::findOrFail($matricule);

        $validated = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:comptes,email,' . $compte->matricule . ',matricule',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type_compte' => 'required|in:admin,personnel',
        ]);

        $compte->nom = $validated['nom'];
        $compte->prenom = $validated['prenom'];
        $compte->email = $validated['email'];
        $compte->type_compte = $validated['type_compte'];

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile-photos', 'public');
            $compte->photo = $path;
        }

        $compte->save();

        return redirect()->route('admin.accounts')
            ->with('success', 'Compte mis à jour avec succès');
    }

    public function destroyAccount($matricule)
    {
        $compte = Compte::findOrFail($matricule);
        $compte->delete();

        return redirect()->route('admin.accounts')
            ->with('success', 'Compte supprimé avec succès');
    }


    public function annulations()
    {
        $annulations = Reservation::where('annulation', true)->with('compte')->get();
        return view('admin.annulations', compact('annulations'));
    }
}

