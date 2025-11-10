<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\ProfileController;


// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
// Ajouter ces routes avant les routes d'authentification existantes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Account management routes
    Route::get('/comptes', [AdminController::class, 'manageAccounts'])->name('admin.accounts');
    Route::get('/comptes/create', [AdminController::class, 'createAccount'])->name('admin.accounts.create');
    Route::post('/comptes', [AdminController::class, 'storeAccount'])->name('admin.accounts.store');
    Route::get('/comptes/{matricule}/edit', [AdminController::class, 'editAccount'])->name('admin.accounts.edit');
    Route::put('/comptes/{matricule}', [AdminController::class, 'updateAccount'])->name('admin.accounts.update');
    Route::delete('/comptes/{matricule}', [AdminController::class, 'destroyAccount'])->name('admin.accounts.destroy');

    Route::get('/reservations', [ReservationController::class, 'adminIndex'])->name('admin.reservations');

    Route::get('/annulations', [AdminController::class, 'annulations'])->name('admin.annulations');
// Statistics Routes
     Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');
    Route::get('/statistiques/day', [StatistiqueController::class, 'byDay'])->name('statistiques.day');
    Route::get('/statistiques/month', [StatistiqueController::class, 'byMonth'])->name('statistiques.month');
});

// User Routes
Route::middleware(['auth', 'personnel'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Reservation Routes
Route::middleware(['auth', 'personnel'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::post('reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
  
});


