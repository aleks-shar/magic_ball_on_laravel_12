<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AskQuestionRequest;
use App\Services\MagicBallService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

final class MagicBallController extends Controller
{
    /**
     * @param MagicBallService $magicBallService
     */
    public function __construct(
        private readonly MagicBallService $magicBallService,
    ) {
    }

    /**
     * @return Renderable
     */
    public function dashboard(): Renderable
    {
        return view('dashboard', [
            'questions' => $this->magicBallService->getQuestions(),
        ]);
    }

    /**
     * @param AskQuestionRequest $request
     * @return RedirectResponse
     */
    public function askQuestion(AskQuestionRequest $request): RedirectResponse
    {
        $question = $this->magicBallService->findOrCreateQuestion($request->question);
        $answer = $this->magicBallService->getRandomAnswer();
        $this->magicBallService->saveAnswer(auth()->user(), $question, $answer);

        return redirect()->route('dashboard')->with([
            'current_answer' => $answer,
            'question_stats' => [
                'text' => $request->question,
                'asked_count' => $question->asked_count,
            ],
        ]);
    }
}
