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
        Log::info('Processing row in QuestionImport: ' . json_encode($row));
        return new Question([
            'question' => $row['question'],
            
        ]);
    }
    
}
