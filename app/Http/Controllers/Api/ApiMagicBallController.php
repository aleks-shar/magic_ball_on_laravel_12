<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiAskQuestionRequest;
use App\Services\AuthService;
use App\Services\MagicBallService;
use Illuminate\Http\JsonResponse;

final class ApiMagicBallController extends Controller
{
    /**
     * @param MagicBallService $magicBallService
     * @param AuthService $authService
     */
    public function __construct(
        private readonly MagicBallService $magicBallService,
        private readonly AuthService $authService,
    ) {
    }

    /**
     * @param ApiAskQuestionRequest $request
     * @return JsonResponse
     */
    public function __invoke(ApiAskQuestionRequest $request): JsonResponse
    {
        $user = $this->authService->userFirstOrCreate($request->identifier);
        $question = $this->magicBallService->findOrCreateQuestion($request->question);
        $answer = $this->magicBallService->getRandomAnswer();
        $this->magicBallService->saveAnswer($user, $question, $answer);

        return response()->json([
            'current_answer' => $answer,
            'question_stats' => [
                'text' => $request->question,
                'asked_count' => $question->asked_count,
            ],
        ]);
    }
}
