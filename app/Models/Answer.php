<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    protected $table = 'participant_answer';
    protected $fillable = [
        
        'question_id',
        'marks',
        'answer',];

    
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}