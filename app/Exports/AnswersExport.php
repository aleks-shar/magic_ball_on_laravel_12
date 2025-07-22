<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\Answer;
use App\Services\MagicBallService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

final class AnswersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return (new MagicBallService())->getQuestionsForExport();
    }

    /**
     * @return array<array-key, string>
     */
    public function headings(): array
    {
        return [
            'Вопрос',
            'Ответ',
            'Когда',
            'Задавался, раз',
        ];
    }

    /**
     * @param Answer $row
     * @return array<int, mixed>
     */
    public function map($row): array
    {
        return [
            $row->question->text,
            $row->response,
            $row->created_at->format('d.m.Y H:i'),
            $row->question->asked_count,
        ];
    }
}
