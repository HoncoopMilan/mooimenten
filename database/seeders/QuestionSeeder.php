<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::create([
            'question' => 'Leukste herinnering',
        ]);
        Question::create([
            'question' => 'Leukste herinnering 2',
        ]);
    }
}
