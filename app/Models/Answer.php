<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $question_id
 * @property string $response
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Answer extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'question_id',
        'response',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
