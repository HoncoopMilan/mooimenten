<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['img', 'questionnaire_id', 'person'];

    use HasFactory;

    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class);
    }
}
