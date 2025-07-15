<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $text
 * @property int $asked_count
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Question extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'text',
        'asked_count',
    ];

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @return void
     */
    public function incrementAskedCount(): void
    {
        $this->update(['asked_count' => $this->asked_count + 1]);
    }
}
