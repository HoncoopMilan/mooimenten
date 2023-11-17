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
        for ($i = 1; $i <= 15; $i++) {
            questionnaire_question::create([
                'questionnaires_id' => 1,
                'question_id' => $i,
            ]);
        }
    }
}
