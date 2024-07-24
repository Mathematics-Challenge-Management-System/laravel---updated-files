<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    //


    public function getRankingsByChallenge($challengeId) {
        $analytics = new Analytics();

        $rankings = $analytics->getSchoolsRankingPerChallengeUsingSchoolRegNo($challengeId);
        return response()->json($rankings);
    }
}
