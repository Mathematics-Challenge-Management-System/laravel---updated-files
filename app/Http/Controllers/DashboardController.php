<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Participant_answer;

class DashboardController extends Controller
{
    public function index()
    {
    $mostCorrectlyAnsweredQuestion = laravelll::table('participant_answer')
        ->where('marks', 1)
        ->groupBy('question_id')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(1)
        ->select('question_id', laravelll::raw('COUNT(*) as correct_answers'))
        ->first();

        return view('pages.dashboard',compact('mostCorrectlyAnsweredQuestion'));
    }
    
 
        public function showAnalytics($challengeId=null){
            // get the scores of each participant and sum them by school
            $schoolScores = Participants::join('attempts', 'participants.id','=','attempts.participant_id')
            ->select('participants.school_id', \DB::raw('SUM(attempts.score) as total_score'))
            ->groupBy('participants.school_id')
            ->orderBy('total_score','desc')
            ->get();
            
            +
            // get the schpool details
            $rankedSchools = $schoolScores->map(function ($schoolScore){
                $school = Schools::find($schoolScore->school_id);
                return[
                    'school_name'=> $school->name,
                    'district'=> $school->district,
                    'total_score'=> $schoolScore->total_score
                ];
            });




        $mostCorrectlyAnsweredQuestions = DB::table('questions')
        ->join('answers','questions.id','=','answers.question_id')
        ->select('questions.question_text', DB::raw('COUNT(answers.is_correct) as correct_count'))//selects the question text and the count of correct answers.
        ->where('answers.is_correct', true)//filters only the correct answers
        ->groupBy('questions.id', 'questions.question_text')//groups by both the question ID and the question text 
        ->orderBy('correct_count','desc')//orders the results by the count of correct answers in descending order.
        ->get();



        $schoolPerformanceOverTime = DB::table('scores')
        ->join('participants','scores.participant_id','=','participants.id')
        ->join('schools','participants.school_id','=','schools.id')
        ->select('schools.name', DB::raw('YEAR(scores.created_at) as year'), DB::raw('SUM(scores.score) as total_score')) 
        ->groupBy('schools.name','year')
        ->orderBy('year','asc') 
        -> get();

        //fetch performance data for graphs
        $participantPerformanceOverTime = DB::table('scores')
        ->join('participants','scores.participant_id','=','participants.id')
        ->select('participants.username', DB::raw('YEAR(scores.created_at) as year'), DB::raw('SUM(scores.score) as total_score'))
        ->groupBy('participants.username','year') 
        ->orderBy('year','asc') 
        ->get();


        // calculate question repetition percentage for each participant
        $participants = DB::table('participants')->get();
        $participantRepetitions = [];

        foreach ($participants as $participant) {
            $attempts= DB::table('attempts')
            ->where('participant_id',  $participant -> id)
            ->pluck('questions_attempted');


            $allQuestions = [];
            foreach ($attempts as $attempt){
                $questions=json_decode($attempt);
                if($questions){
                    $allQuestions= array_merge($allQuestions, $questions);
                }
            }

            $questionCounts= array_count_values($allQuestions);
            $totalQuestions= count($allQuestions);
            $repeatedQuestions= 0;


            foreach($questionCounts as $count){
                if($count > 1){
                    $repeatedQuestions += ($count - 1);
            }
        }


        $repetitionPercentage = 0;
        if($totalQuestions > 0){
            $repetitionPercentage = ($repeatedQuestions / $totalQuestions) *100;
        }


        $participantRepetitions[] = [
            'participant_id'=> $participant->id,
            'username'=> $participant->username,
            'repetition_percentage'=> $repetitionPercentage,
        ];
    }


    //retrieve the worst performing schools for the specified challenge


    //query to get the total scores for each school for the given challenge
    $challengeScore = DB::table('attempts')
    ->join('participants','attempts.participant_id','=','participants.id')
    ->join('schools','participants.school_id','=','schools.id')
    ->select('schools.name', 'schools.district', DB::raw('SUM(attempts.score) as total_score'))
    ->where('attempts.challenge_id', $challengeId)
    ->groupBy('schools.id', 'schools.name', 'schools.district')
    ->orderBy('total_score','asc')
    ->get();

    $challengeName = null;

    $challenge = DB::table('challenges')
        ->where('id', $challengeId)
        ->first();

        $challengeName = $challenge ? $challenge->name :'null';



    $bestSchoolsForAllCha= DB::table('challenges')
    ->leftJoin('attempts','challenges.id','=','attempts.challenge_id')
    ->leftJoin('participants','attempts.participant_id','=','participants.id')
    ->leftJoin('schools','participants.school_id','=','schools.id')
    ->select('challenges.name as challenge_name', 'challenges.id as challenge_id', 'schools.name as school_name', DB::raw('SUM(attempts.score) as total_score'))
    ->groupBy('challenges.id', 'schools.name', 'challenges.name')
    ->orderBy('total_score','desc')
    ->get()
    ->groupBy('challenge_id')
    ->map(function ($challenges){
        return $challenges->sortByDesc('total_score')->first();
    });





     $incompleteParticipants= DB::table('participants')
     ->join('attempts','participants.id','=','attempts.participant_id')
     ->join('challenges','attempts.challenge_id','=','challenges.id')
     ->select('participants.id', 'participants.username', 'challenges.name', 'attempts.questions_attempted', 'challenges.number__of_questions')
    //  ->whereColumn('attempts.questions_attempted', '<','challenges.number__of_questions')
     ->get();

    //  process the questions_attempted to count the strings in the array
    foreach($incompleteParticipants as $participant){
        $questionsArray=json_decode($participant->questions_attempted, true);
        $participant->questions_attempted_count = is_array($questionsArray) ? count($questionsArray) :0;
    }

   




        // Pass all data to the view
            return view('Analytics', compact('mostCorrectlyAnsweredQuestions', 'rankedSchools', 'schoolPerformanceOverTime', 'participantPerformanceOverTime', 'participantRepetitions', 'challengeScore', 'challengeName', 'bestSchoolsForAllCha', 'incompleteParticipants')); //pass the data to the view
        }
}

