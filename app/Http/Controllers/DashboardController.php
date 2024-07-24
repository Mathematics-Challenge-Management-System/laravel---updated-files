<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Participant_answer;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
    $mostCorrectlyAnsweredQuestion = laravelll::table('participant_answer')
        ->where('mark', 1)
        ->groupBy('question_id')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(1)
        ->select('question_id', laravelll::raw('COUNT(*) as correct_answers'))
        ->first();
    Log::info('most correct'.$mostCorrectlyAnsweredQuestion);

//        $mostCorrectlyAnsweredQuestion=90;
        return view('pages.dashboard',$mostCorrectlyAnsweredQuestion);
    }

}
