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
            'question' => 'Leukste herinnering %name%',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 2',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 3',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 4',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 5',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 6',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 7',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 8',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 9',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 10',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 11',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 12',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 13',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 14',
        ]);
        Question::create([
            'question' => 'Leukste herinnering %name% 15',
        ]);
    }
}
