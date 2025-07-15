<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $identifier
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'identifier',
    ];

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
