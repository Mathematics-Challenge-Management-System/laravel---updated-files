<?php
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Participant_answer; // Ensure your namespace is correct, usually, it's `Models` with an uppercase 'M'
=======
namespace App\Http\Controllers;
>>>>>>> 552908c26abc96508bd6ffc57353b2826490491e


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class DashboardController extends Controller
{
<<<<<<< HEAD
    public function index()
    {
        $mostCorrectlyAnsweredQuestion = DB::table('participant_answer')
            ->where('mark', 1)
            ->groupBy('question_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->select('question_id', DB::raw('COUNT(*) as correct_answers'))
            ->first();

        Log::info('most correct: '. $mostCorrectlyAnsweredQuestion);

        // Correct way to pass data to a view
        return view('pages.dashboard', ['mostCorrectlyAnsweredQuestion' => $mostCorrectlyAnsweredQuestion]);
    }
}
=======
public function index()
{
$mostCorrectlyAnsweredQuestion = DB::table('question')
->whereIn('question_id', function($query) {
$query->select('question_id')
->from(function($sub) {
$sub->select('question_id', DB::raw('COUNT(answer)'))
->from('participant_answer')
->where('marks', '>', 0)
->whereIn('participant_challenge_id', function($subQuery) {
$subQuery->select('participant_challenge_id')
->from('participant_challenge')
->whereIn('challenge_id', function($innerQuery) {
$innerQuery->select('challenge_id')
->from('challenge')
->where('challenge_name', '=', 'trees');
});
})
->groupBy('question_id')
->orderByRaw('COUNT(answer) DESC')
->limit(1)
->toSql();
}, 't1');
})
->first();

Log::info('Most correctly answered question: ' . json_encode($mostCorrectlyAnsweredQuestion));
    $mostCorrectlyAnsweredQuestion=34;

    return view('pages.dashboard', compact('mostCorrectlyAnsweredQuestion'));
}

}
>>>>>>> 552908c26abc96508bd6ffc57353b2826490491e
