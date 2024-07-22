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
       
        
            
          
        //to avoid duplicate records
    }
}
