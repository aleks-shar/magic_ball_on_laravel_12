<?php

declare(strict_types=1);

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\MagicBallController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [MagicBallController::class, 'dashboard'])->name('dashboard');
    Route::post('/ask-question', [MagicBallController::class, 'askQuestion'])->name('ask-question');
});
