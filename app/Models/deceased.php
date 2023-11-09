<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deceased extends Model
{
    protected $fillable = ['name', 'date_of_birth', 'date_of_death', 'zipcode', 'city', 'adress', 'img'];

    use HasFactory;

    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }
}
