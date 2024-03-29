<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['answer', 'questionnaire_id', 'question_id', 'person'];

    use HasFactory;


    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
