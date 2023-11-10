<?php

namespace Database\Seeders;

use App\Models\questionnaire_question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Questionnaire_questionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        questionnaire_question::create([
            'questionnaires_id' => 1,
            'question_id' => 1,
        ]);
        questionnaire_question::create([
            'questionnaires_id' => 1,
            'question_id' => 2,
        ]);
    }
}
