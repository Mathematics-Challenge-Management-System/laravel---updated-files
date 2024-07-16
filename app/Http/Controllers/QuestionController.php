<?php
namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Question;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionImport;
use App\Imports\AnswerImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Answer;



use Illuminate\Support\Facades\Validator;


class QuestionController extends Controller
{
    public function upload(Request $request)
    {
        
        $request->validate([

        ]);

        $questions = $request->file('question_document');
        $answers =  $request->file('answer_document');

        DB::beginTransaction();
        try {
            Excel::import(new QuestionImport, $questions);
            Excel::import(new AnswerImport, $answers);
            Excel::import(new QuestionImport, $questions, null, \Maatwebsite\Excel\Excel::XLSX, [
                'chunk' => 1000
                
            ]);
           
            DB::commit();

            
            // After successful import, check the count
            $questionCount = Question::count();
            $answerCount = Answer::count();
            Log::info("After import: {$questionCount} questions and {$answerCount} answers in database");
    
            
        
        return back()->with('success', 'Questions and answers uploaded successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Import failed: ' . $e->getMessage());
        }
        echo "Upload function called!";
    }
}