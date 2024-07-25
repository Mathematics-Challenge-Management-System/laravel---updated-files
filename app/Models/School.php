<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class School extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'school_representative';
    // Fetch the data from the database
    public function index()
{

$school_representative = School::orderBy('school_name')->paginate(40);

// Pass the paginated data to the view
return view('pages.school-management', ['school_representative' => $school_representative]);
}
//    protected $primaryKey = 'school_regNo';
//public $incrementing = false;
//protected $keyType = 'string';
//public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'school_name',
        'school_regNo',
        'school_district',
        'school_phone',
        'rep_name',
        'rep_username',
        'rep_email',
        'rep_phone',
        'rep_password',

    ];
public function bestPerformingSchools($scoreThreshold = 50)
{
     $query = DB::table('school_representative')
    ->select([
        'school_representative.school_name',
        'school_representative.school_regNo',
        'school_representative.school_district',
        DB::table('SUM(participant_challenge.score) AS total_score'),
    ])
    ->join('participant', 'school_representative.school_regNo', '=', 'participant.school_regNo')
    ->join('participant_challenge', 'participant.id', '=', 'participant_challenge.participant_id')
    ->groupBy('school_representative.school_regNo')
    ->having('total_score', '>', $scoreThreshold)
    ->orderBy('total_score', 'DESC');
    
    }


}
