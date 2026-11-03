<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', fn() => redirect()->route('assets.index'));
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('assets', AssetController::class)->only(['index', 'show']);
});
