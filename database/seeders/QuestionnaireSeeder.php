<?php

namespace Database\Seeders;

use App\Models\Questionnaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Questionnaire::create([
            'name' => 'Vragenlijst 1',
            'completed_times' => 2,
            'deceased_id' => 1,
            'expire' => now(),
            'customer_code' => 'AREWfcew$2',
        ]);
    }
}
