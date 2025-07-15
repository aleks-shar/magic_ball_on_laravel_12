<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ApiMagicBallController;
use Illuminate\Support\Facades\Route;

Route::post('/ask-question', ApiMagicBallController::class)->name('api-ask-question');
