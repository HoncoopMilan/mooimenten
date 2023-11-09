<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = ['name'];

    use HasFactory;

    public function questionnaire_question(){
        return $this->hasMany(questionnaire_question::class);
    }

    public function deceased(){
        return $this->belongsTo(Deceased::class);
    }
}
