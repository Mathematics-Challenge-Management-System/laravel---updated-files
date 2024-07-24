<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Analytics extends Model
{use HasFactory;
//    this class shall run queries for analytics from the database

// method to return number of schools in school_representative table
    public function getSchoolsCount(){
        return DB::table('school_representative')->count();
    }
// method to return number of challenges in challenge table
    public function getChallengesCount(){
        return DB::table('challenge')->count();
    }
// method to return number of participants in participant table
    public function getParticipantsCount(){
        return DB::table('participant')->count();
    }

    // method to return the most correctly answered question in a challenge
    public function getMostCorrectlyAnswered($challengeName) {
        return DB::table('question')
            ->select('question')
            ->whereIn('question_id', function($query) use ($challengeName) {
                $query->select('question_id')
                    ->from(function($sub) use ($challengeName) {
                        $sub->select('question_id', DB::raw('COUNT(answer)'))
                            ->from('participant_answer')
                            ->where('marks', '>', 0)
                            ->whereIn('participant_challenge_id', function($subQuery) use ($challengeName) {
                                $subQuery->select('participant_challenge_id')
                                    ->from('participant_challenge')
                                    ->whereIn('challenge_id', function($innerQuery) use ($challengeName) {
                                        $innerQuery->select('challenge_id')->from('challenge')->where('challenge_name', '=', $challengeName);
                                    });
                            })
                            ->groupBy('question_id')
                            ->orderByRaw('COUNT(answer) DESC')
                            ->limit(1)
                            ->toSql();
                    }, 't1');
            })
            ->first();
    }
    //method to return number of challenge attempts in the whole system
    public function getChallengeAttempts(){
        return DB::table('participant_challenge')->count();
    }

    //a method to return an array containing challenge names and the  total attempts for each challenge in the system
    public function getChallengeAttemptsByChallenge(){
        return DB::table('challenge')
            ->select('challenge_name', DB::raw('COUNT(participant_challenge_id) as total_attempts'))
            ->leftJoin('participant_challenge', 'challenge.challenge_id', '=', 'participant_challenge.challenge_id')
            ->groupBy('challenge.challenge_id')
            ->get();
    }

    //a method to return a 2 dimensional array containing the raking of schools per challenge with school name, percentage score out of a total of 10 and the average score of each challenge attempt for students from each school
    //the inner arrays should contain the school name,challenge name, average percentage score of participants from the school and average score of participants per challenge

    public function getSchoolsRankingPerChallengeUsingSchoolRegNo() {
        $schools = DB::table('school_representative')->get();
        $challenges = DB::table('challenge')->get();
        $results = [];

        foreach ($schools as $school) {
            foreach ($challenges as $challenge) {
                $totalMarks = DB::table('participant_challenge')
                    ->join('participant', 'participant_challenge.participant_id', '=', 'participant.participant_id')
                    ->join('challenge', 'participant_challenge.challenge_id', '=', 'challenge.challenge_id')
                    ->where('participant.schoolRegNo', $school->school_regNo)
                    ->where('challenge.challenge_id', $challenge->challenge_id)
                    ->sum('score');

                $totalAttempts = DB::table('participant_challenge')
                    ->join('participant', 'participant_challenge.participant_id', '=', 'participant.participant_id')
                    ->join('challenge', 'participant_challenge.challenge_id', '=', 'challenge.challenge_id')
                    ->where('participant.schoolRegNo', $school->school_regNo)
                    ->where('challenge.challenge_id', $challenge->challenge_id)
                    ->count();

                $averageScore = $totalAttempts > 0 ? $totalMarks / $totalAttempts : 0;
                $percentageScore = ($averageScore / 10) * 100; // Assuming total possible score is 10

                $results[] = [
                    'school_name' => $school->school_name,
                    'challenge_name' => $challenge->challenge_name,
                    'average_percentage_score' => $percentageScore,
                    'average_score' => $averageScore
                ];
            }
        }

        return $results;
    }



}
