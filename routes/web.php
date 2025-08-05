<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return response()->redirectToRoute('auth.login.index');
})->name('welcome');

Route::prefix('auth')->as('auth.')->group(function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login.index');
        Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.store');
        
        Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register.index');
        Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect(route('auth.login.index'));
})->name('logout');