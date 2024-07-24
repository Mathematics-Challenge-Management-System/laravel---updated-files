<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Participant_answer; // Ensure your namespace is correct, usually, it's `Models` with an uppercase 'M'

class DashboardController extends Controller
{
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