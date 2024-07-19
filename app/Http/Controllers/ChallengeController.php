<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Question;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionsImport;
use App\Imports\AnswersImport;



class ChallengeController extends Controller
{
    public function create()
{

    $challenge = new Challenge(); // Create a new Challenge instance

    return view('pages.challenge-creation', compact( 'challenge'));
}

        public function index()
        {
            $allChallenges = Challenge::all(); // Retrieve all challenges
            return view('pages.challenge-index', compact('allChallenges'));
        }



    public function store(Request $request)
    {
   try {
        $validatedData = $request->validate([
            'challenge_name' => 'required|string|max:255',
            'challenge_description' => 'required|string|max:20',
            'challenge_start_date' => 'required|date',
            'challenge_end_date' => 'required|date|after:start_date',

        ]);

        $challenge = new Challenge();
        $challenge->challenge_name = $request->input('challenge_name');
        $challenge->challenge_description = $request->input('challenge_description');
        $challenge->challenge_start_date = $request->input('challenge_start_date');
        $challenge->challenge_end_date = $request->input('challenge_end_date');
        $challenge->wrong_answer_marks=$request->input('wrong_answer_marks');
        $challenge->blank_answer_marks=$request->input('blank_answer_marks');
        $challenge->questions_to_answer=$request->input('questions_to_answer');

        $challenge->save();

        return redirect()->route('challenges.create')->with('success', 'Challenge created successfully!');


     }catch (\Exception $e) {
        \Log::error('Database error: ' . $e->getMessage());
        return back()->with('error', 'An error occurred while creating the challenge.');
    }
      }



    public function uploadQuestions(Request $request)
    {
        $request->validate([
            'challenge_description' => 'required|exists:challenges,id',
            'question_document' => 'required|file|mimes:xlsx,xls',
        ]);

        $challenge = Challenge::findOrFail($request->challenge_id);

        // Process Excel file and create questions
        $spreadsheet = IOFactory::load($request->file('question_document'));
        $worksheet = $spreadsheet->getActiveSheet();

        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $rowData = [];
            foreach ($cellIterator as $cell) {
                $rowData[] = $cell->getValue();
            }

            // Assuming the Excel has columns: question, answer, marks
            Question::create([
                'question' => $rowData[0],
                'answer' => $rowData[1],
                'marks' => $rowData[2] ?? 1,
                'challenge_description' => $challenge->id,
            ]);
        }

        return redirect()->route('challenges.index')->with('success', 'Questions uploaded successfully!');
    }

public function uploadExcel(Request $request)
{
    $request->validate([
        'questions_document' => 'required|mimes:xlsx,xls',
        'answers_document' => 'required|mimes:xlsx,xls',
    ]);

    try {
        $questions = Excel::toCollection(new QuestionsImport, $request->file('questions_document'))->first();
        $answers = Excel::toCollection(new AnswersImport, $request->file('answers_document'))->first();

        // Process and merge the data
        $this->processQuestionAnswers($questions, $answers);

        return redirect()->back()->with('success', 'Excel files imported successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error importing files: ' . $e->getMessage());
    }
}

private function processQuestionAnswers($questions, $answers)
{
    foreach ($questions as $index => $question) {
        if (isset($answers[$index])) {
            Question::create([
                'question' => $question['question'],
                'answer' => $answers[$index]['answer'],
                'marks' => $answers[$index]['marks'],
            ]);
        }
    }
}
}
