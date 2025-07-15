<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

final class AuthService
{
    /**
     * @param string $identifier
     * @return User
     */
    public function userFirstOrCreate(string $identifier): User
    {
        return User::query()->firstOrCreate([
            'identifier' => $identifier,
        ]);
    }
}
