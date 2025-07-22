<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Question;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class MagicBallService
{
    private const int PAGINATE = 10;
    private const array POSSIBLE_ANSWERS = [
        'Да.',
        'Нет.',
        'Возможно.',
        'Вопрос не ясен.',
        'Абсолютно точно.',
        'Никогда.',
        'Даже не думай.',
        'Сконцентрируйся и спроси опять.',
    ];

    /**
     * @return LengthAwarePaginator
     */
    public function getQuestions(): LengthAwarePaginator
    {
        return auth()->user()->answers()
            ->with('question')
            ->latest()
            ->paginate(self::PAGINATE);
    }

    /**
     * @return string
     */
    public function getRandomAnswer(): string
    {
        return self::POSSIBLE_ANSWERS[array_rand(self::POSSIBLE_ANSWERS)];
    }

    /**
     * @param string $questionText
     * @return Question
     */
    public function findOrCreateQuestion(string $questionText): Question
    {
        $question = Question::query()->firstOrCreate([
            'text' => $questionText,
        ]);

        $question->incrementAskedCount();

        return $question;
    }

    /**
     * @param User $user
     * @param Question $question
     * @param string $answer
     * @return void
     */
    public function saveAnswer(User $user, Question $question, string $answer): void
    {
        $user->answers()->create([
            'question_id' => $question->id,
            'response' => $answer,
        ]);
    }

    /**
     * @return Collection
     */
    public function getQuestionsForExport(): Collection
    {
        return auth()->user()->answers()
            ->with('question')
            ->latest()
            ->get();
    }
}
