<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PointController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('role:admin')->group(function (): void {
        Route::resource('members', MemberController::class)->except('update');
        Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
        Route::get('/members/{member}/points/create', [PointController::class, 'create'])->name('points.create');
        Route::post('/members/{member}/points', [PointController::class, 'store'])->name('points.store');
    });

    Route::middleware('role:user')->group(function (): void {
        Route::get('/profile', [MemberController::class, 'profile'])->name('profile');
    });

    Route::get('/histories', [PointController::class, 'index'])->name('points.index');
});
