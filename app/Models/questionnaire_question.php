<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questionnaire_question extends Model
{
    use HasFactory;

    public function Deceased(){
        return $this->hasMany(Deceased::class);
    }
}