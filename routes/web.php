<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TerrainController;

// Public routes - Redirect to login if not authenticated
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // Redirect admin to admin dashboard, regular users to main dashboard
    return auth()->user()->isAdmin() ? redirect()->route('admin.dashboard') : redirect()->route('dashboard');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected routes
Route::middleware('auth')->group(function () {
    // Terrain routes
    Route::resource('terrains', TerrainController::class)->only(['index', 'show']);

    // Client-only reservation routes
    Route::middleware('client')->group(function () {
        Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
        Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    });

    // Reservation routes (view/cancel for all authenticated users)
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::post('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');

    // Profile routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    // Utilisateurs
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [App\Http\Controllers\AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [App\Http\Controllers\AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.destroy');

    // Terrains
    Route::get('/terrains', [App\Http\Controllers\AdminController::class, 'terrains'])->name('terrains');
    Route::get('/terrains/create', [App\Http\Controllers\AdminController::class, 'createTerrain'])->name('terrains.create');
    Route::post('/terrains', [App\Http\Controllers\AdminController::class, 'storeTerrain'])->name('terrains.store');
    Route::get('/terrains/{terrain}/edit', [App\Http\Controllers\AdminController::class, 'editTerrain'])->name('terrains.edit');
    Route::put('/terrains/{terrain}', [App\Http\Controllers\AdminController::class, 'updateTerrain'])->name('terrains.update');
    Route::delete('/terrains/{terrain}', [App\Http\Controllers\AdminController::class, 'deleteTerrain'])->name('terrains.destroy');

    // Équipements
    Route::get('/equipements', [App\Http\Controllers\AdminController::class, 'equipements'])->name('equipements');
    Route::get('/equipements/create', [App\Http\Controllers\AdminController::class, 'createEquipement'])->name('equipements.create');
    Route::post('/equipements', [App\Http\Controllers\AdminController::class, 'storeEquipement'])->name('equipements.store');
    Route::get('/equipements/{equipement}/edit', [App\Http\Controllers\AdminController::class, 'editEquipement'])->name('equipements.edit');
    Route::put('/equipements/{equipement}', [App\Http\Controllers\AdminController::class, 'updateEquipement'])->name('equipements.update');
    Route::delete('/equipements/{equipement}', [App\Http\Controllers\AdminController::class, 'deleteEquipement'])->name('equipements.destroy');

    // Réservations
    Route::get('/reservations', [App\Http\Controllers\AdminController::class, 'reservations'])->name('reservations');
    Route::get('/reservations/{reservation}', [App\Http\Controllers\AdminController::class, 'showReservation'])->name('reservations.show');
    Route::post('/reservations/{reservation}/status', [App\Http\Controllers\AdminController::class, 'updateReservationStatus'])->name('reservations.status');
});
