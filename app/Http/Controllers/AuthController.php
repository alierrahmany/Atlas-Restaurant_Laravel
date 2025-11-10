<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Compte;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:comptes',
            'motdepasse' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Générer un matricule unique
        $matricule = 'EMP' . strtoupper(Str::random(6)) . date('ym');

        // Utiliser l'email comme login (ou générer un login basé sur le nom/prénom)
        $login = strtolower($request->prenom . '.' . $request->nom);

        $compte = Compte::create([
            'matricule' => $matricule,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'login' => $login, // Utiliser email comme login ou générer automatiquement
            'motdepasse' => Hash::make($request->motdepasse),
            'type_compte' => 'personnel', // Par défaut, tous les nouveaux comptes sont "personnel"
            'photo' => null,
        ]);

        // Connecter automatiquement l'utilisateur après l'inscription
        Auth::login($compte);

        return redirect()->route('user.dashboard')
            ->with('success', 'Compte créé avec succès ! Bienvenue ' . $compte->prenom);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'motdepasse' => 'required|string',
        ]);

        // Rechercher par email
        $compte = Compte::where('email', $credentials['email'])->first();

        if ($compte && Hash::check($credentials['motdepasse'], $compte->motdepasse)) {
            Auth::login($compte, $request->has('remember'));

            if ($request->has('remember')) {
                $request->session()->put('email', $credentials['email']);
            }

            if ($compte->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}