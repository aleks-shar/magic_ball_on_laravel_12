<?php

declare(strict_types=1);

namespace App\Http\Requests\Web;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class AskQuestionRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'min:5', 'max:255'],
        ];
    }
}
