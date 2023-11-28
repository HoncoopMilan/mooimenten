<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = ['name'];

    use HasFactory;

    public function questions(){
        return $this->belongsToMany(Question::class);
    }

    public function deceased(){
        return $this->belongsTo(Deceased::class);
    }
}
