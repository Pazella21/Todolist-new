<?php

use App\Http\Controllers\Halo\HaloController;
use App\Http\Controllers\Todo\TodoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

// RUTE UMUM
Route::get('/', function () {
    return view('welcome');
});

Route::get('/halo', [HaloController::class, 'index']);

// RUTE REGISTRASI
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

// RUTE GUEST (LOGIN & FORGOT PASSWORD)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Rute untuk menampilkan form input email lupa password
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
});

// --- RUTE VERIFIKASI (TARUH DI LUAR MIDDLEWARE AGAR BISA DIAKSES SAAT LOGOUT) ---
Route::post('/verify', [VerificationController::class, 'store'])->name('verification.store');
Route::get('/verify/{unique_id}', [VerificationController::class, 'show'])->name('verification.show');
Route::put('/verify/{unique_id}', [VerificationController::class, 'update'])->name('verification.update');

// Rute untuk reset password dengan OTP (setelah verifikasi sukses)
Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


// RUTE KHUSUS CUSTOMER (DIBUNGKUS AUTH)
Route::middleware(['auth', 'check_role:customer', 'check_status'])->group(function () {
    Route::get('/customer', fn() => 'Halaman customer');
    Route::get('/verify-index', [VerificationController::class, 'index'])->name('verification.index');
});

// RUTE AUTH UMUM
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/todo', [TodoController::class, 'index'])->name('todo');
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.post');
    Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//RUTE UNTUK LOGIN KE GOOGLE
//route untuk mengarahkan halaman login google
Route::get('/auth/google', [AuthController::class,'redirectToGoogle'])->name('google.login');
//route callback setelah user login di google
Route::get('/auth/google/callback', [AuthController::class,'handleGoogleCallback']);
