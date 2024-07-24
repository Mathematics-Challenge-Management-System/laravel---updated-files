<?php
namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class DashboardController extends Controller
{
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

