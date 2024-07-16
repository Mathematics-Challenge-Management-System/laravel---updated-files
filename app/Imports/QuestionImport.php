<?php
namespace App\Imports;
use App\Models\Question;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // The collection will be handled in the controller
        return $rows;
    }



    public function model(array $row)
    {
        return new Question([
            'question' => $row['question'],
        ]);
    }
    public function getQuestionIds()
    {
        return $this->questionIds;
    }
}
