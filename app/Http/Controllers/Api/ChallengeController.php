<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::valid()->get();
        return response()->json($challenges);
    }

    
        
        // Here you would implement the logic for:
        // 1. Checking if the challenge is open
        // 2. Selecting random questions
        // 3. Processing the participant's answers
        // 4. Calculating scores
        // 5. Recording the attempt

    
    public function attemptChallenge(Request $request, $challengeId)
    {
        $challenge = Challenge::findOrFail($challengeId);
        $participant = auth()->user(); // Assuming you're using authentication
    
        // Check if the challenge is open
        if (!$challenge->isOpen()) {
            return response()->json(['error' => 'This challenge is not currently open'], 403);
        }
    
        // 1. Selecting random questions
        $questions = $this->selectRandomQuestions($challenge);
    
        // 2. Processing the participant's answers
        $answers = $request->input('answers');
        $results = $this->processAnswers($questions, $answers);
    
        // 3. Calculating scores
        $score = $this->calculateScore($results, $challenge);
    
        // 4. Recording the attempt
        $attempt = $this->recordAttempt($participant, $challenge, $score, $results);
    
        return response()->json([
            'message' => 'Challenge attempt recorded',
            'score' => $score,
            'attempt_id' => $attempt->id,
        ]);
    }
    
    private function selectRandomQuestions(Challenge $challenge)
    {
        return Question::where('challenge_id', $challenge->id)
                       ->inRandomOrder()
                       ->limit($challenge->questions_to_answer)
                       ->get();
    }
    
    private function processAnswers($questions, $answers)
    {
        $results = [];
        foreach ($questions as $question) {
            $givenAnswer = $answers[$question->id] ?? null;
            $isCorrect = $givenAnswer === $question->correct_answer;
            $results[] = [
                'question_id' => $question->id,
                'given_answer' => $givenAnswer,
                'is_correct' => $isCorrect,
                'marks' => $isCorrect ? $question->marks : ($givenAnswer === null ? 0 : -3) // Assuming -3 for wrong answers
            ];
        }
        return $results;
    }
    
    private function calculateScore($results, Challenge $challenge)
    {
        $totalScore = 0;
        foreach ($results as $result) {
            $totalScore += $result['marks'];
        }
        return max(0, $totalScore); // Ensure score doesn't go below 0
    }
    
    private function recordAttempt($participant, Challenge $challenge, $score, $results)
    {
        $attempt = new Attempt();
        $attempt->participant_id = $participant->id;
        $attempt->challenge_id = $challenge->id;
        $attempt->score = $score;
        $attempt->save();
    
        foreach ($results as $result) {
            AttemptAnswer::create([
                'attempt_id' => $attempt->id,
                'question_id' => $result['question_id'],
                'given_answer' => $result['given_answer'],
                'is_correct' => $result['is_correct'],
                'marks' => $result['marks']
            ]);
        }
    
        return $attempt;
    }
    // Add more methods as needed, such as:
    // - viewChallenges
    // - getChallengeclosedDate
    // - getQuestions
    // - submitAnswers
    // etc.
}