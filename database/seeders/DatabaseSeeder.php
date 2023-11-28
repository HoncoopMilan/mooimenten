<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Questionnaire;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DeceasedSeeder::class,
            QuestionnaireSeeder::class,
            QuestionSeeder::class,
        ]);

        foreach(\App\Models\Question::all() as $question){
            $questionnaire = Questionnaire::find(1);
            $questionnaire->questions()->attach($question);
        }


    }
}
