<?php
namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Question;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionImport;
use App\Imports\AnswerImport;



use Illuminate\Support\Facades\Validator;


class QuestionController extends Controller
{
    public function upload(Request $request)
    {
        // ...
        error_reporting(E_ALL);
ini_set('display_errors', 1);
        echo "Upload function called!";
    
        $questionFile = $request->file('question_document');
        $answerFile = $request->file('answer_document');
        $validator = Validator::make($request->all(), [
            'question_document' => 'required|mimes:xlsx|max:1024',
            'answer_document' => 'required|mimes:xlsx|max:1024',
        ]);
        
        if ($validator->fails()) {
            // Handle validation errors
            return back()->withErrors($validator);
        }
        // Import the Excel files
        $questions = Excel::toCollection(new QuestionImport, $questionFile);
        $answers = Excel::toCollection(new AnswerImport(new Question), $answerFile);
    
        




$questionsArray = $questions->toArray()[0];
$answersArray = $answers->toArray()[0];

    
        // Merge the questions and answers into a single array
        

        $mergedData = array();
        foreach ($questionsArray as $key => $question) {
            $answer = $answersArray[$key];
            $mergedData[] = [$question, $answer];
        }
        
        foreach ($mergedData as $data) {
            $questionModel = new Question();
            Question::create([
                'question' => $data[0],
                'answer' => $data[1],
            ]);
            $questionModel->save();
        }
    



            
    
                

        
        return back()->with('success', 'Questions and answers uploaded successfully!');
    
        echo "Upload function called!";
    }
}