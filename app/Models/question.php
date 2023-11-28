<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question'];

    use HasFactory;

    public function questionnaires(){
        return $this->belongsToMany(Questionnaire::class);
    }
}
