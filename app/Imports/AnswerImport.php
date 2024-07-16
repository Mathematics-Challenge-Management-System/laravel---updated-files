<?php
namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class AnswerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $answer = Answer::where('question',$row['question'])->first();
        
        
            Log::info('Processing row: ' . json_encode($row));
    
            try {
                return new Question([
                    'question' => $row['question'],
                    'answer' => $row['answer'],
                    'marks' => $row['marks'],
                ]);
            } catch (\Exception $e) {
                Log::error('Error creating Question model: ' . $e->getMessage());
        //to avoid duplicate records
    }
}
}