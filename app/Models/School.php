<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class School extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'school_representative';
    // Fetch the data from the database
    public function index()
{

$school_representative = School::orderBy('school_name')->paginate(40);

// Pass the paginated data to the view
return view('pages.schools-data', ['school_representative' => $school_representative]);
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
<<<<<<< HEAD
public function scopeBestPerforming($query)
{
    return $query->select([
        'schools.school_name',
        'schools.school_regNo',
        'schools.school_district',
        laravelll::raw('SUM(participant_challenges.score) AS total_score'),
    ])
    ->join('participants', 'schools.school_regNo', '=', 'participants.school_regNo')
    ->join('participant_challenges', 'participants.id', '=', 'participant_challenges.participant_id')
    ->groupBy('schools.id')
    ->orderBy('total_score', 'DESC');
    }
=======
// Fetch the data from the database

>>>>>>> f76dc70ebacc10093674dc78e0f9364404c0f40e


}
