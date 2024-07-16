<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'participant_answer';
    protected $fillable = [
        'participant_challenge_id',
        'question_id',
        'marks',
        'answer',];

    }