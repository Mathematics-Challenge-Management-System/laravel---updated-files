<?php
namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnswerImport implements ToModel, WithHeadingRow
{
    private $questionIds;

    public function __construct($questionIds)
    {
        $this->questionIds = $questionIds;
    }

    public function model(array $row)
    {
        $questionId = array_shift($this->questionIds);
        $answer = new Answer([
            'question_id' => $questionId,
            'answer' => $row['answer'],
        ]);
        $answer->save();
        return $answer;
    }
}