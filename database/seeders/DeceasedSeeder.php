<?php

namespace Database\Seeders;

use App\Models\Deceased;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DeceasedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Deceased::create([
            'name' => 'Jan',
            'adress' => 'De Molenstraat 48',
            'city' => 'Oudenbosch',
            'date_of_birth' => Carbon::create('1996', '11', '13'),
            'date_of_death' => Carbon::create('2023', '11', '06'),
            'zipcode' => '3844HM',
            'img' => 'img'
        ]);
    }
}
