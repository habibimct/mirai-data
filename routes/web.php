<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ======================
// HALAMAN AWAL
// ======================
Route::get('/', function () {
    return view('welcome');
});

// ======================
// DASHBOARD
// ======================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// ======================
// ROUTE LOGIN (SEMUA USER)
// ======================
Route::middleware(['auth'])->group(function () {

    // PROFILE (BREEZE)
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // ======================
    // PARTICIPANTS (READ ONLY)
    // ======================
    Route::controller(ParticipantController::class)->group(function () {
        Route::get('participants', 'index')->name('participants.index');
        Route::get('participants/{id}', 'show')->name('participants.show');
    });

    // ======================
    // ADMIN ONLY
    // ======================
    Route::middleware(['auth'])->group(function () {

        Route::controller(ParticipantController::class)->group(function () {

            // ✅ ADMIN dulu
            Route::middleware('role:admin')->group(function () {
                Route::get('participants/create', 'create')->name('participants.create');
                Route::post('participants', 'store')->name('participants.store');
                Route::get('participants/{id}/edit', 'edit')->name('participants.edit');
                Route::put('participants/{id}', 'update')->name('participants.update');
                Route::delete('participants/{id}', 'destroy')->name('participants.destroy');
                Route::post('/participants/import', 'import')->name('participants.import');
                Route::resource('users', UserController::class);
            });

            // ✅ PUBLIC setelah itu
            Route::get('participants', 'index')->name('participants.index');

            // ❗ PALING BAWAH
            Route::get('participants/{id}', 'show')
                ->where('id', '[0-9]+')
                ->name('participants.show');

            Route::post('/update-invite-code', [DashboardController::class, 'updateInviteCode'])->name('update.invite.code');
        });
    });
});

// ======================
// AUTH ROUTES (BREEZE)
// ======================
require __DIR__ . '/auth.php';
