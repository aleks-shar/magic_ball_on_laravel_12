<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param AuthService $service
     * @return RedirectResponse
     */
    public function login(LoginRequest $request, AuthService $service): RedirectResponse
    {
        Auth::login($service->userFirstOrCreate($request->identifier));

        return redirect()->route('dashboard');
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
