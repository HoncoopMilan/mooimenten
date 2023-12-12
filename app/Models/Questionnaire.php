<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = ['name', 'expire', 'customer_code'];

    use HasFactory;

    public function questions(){
        return $this->belongsToMany(Question::class);
    }

    public function deceased(){
        return $this->belongsTo(Deceased::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    
}
