<?php
namespace App\Imports;
use App\Models\Question;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;


class QuestionImport implements WithHeadingRow
{



    public function model(array $row)
    {
        $question = Question::where('question_id',$row['question'])->first();
        
        Log::info('Processing row in QuestionImport: ' . json_encode($row));
        try {
            return new Question([
                'question' => $row['question'],
                'answer' => $row['answer'],
                'marks' => $row['marks'],
                
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating Question model: ' . $e->getMessage());
    }
    
}
}