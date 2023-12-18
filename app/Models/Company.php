<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'logo', 'color'];

    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }
}
