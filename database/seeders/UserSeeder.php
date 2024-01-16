<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'password' => '$2y$12$Hyi1KiFQCgyUk8Cbe7XgCeFoNrea8sKRo2tOd6iO155hHJu1iPLi6',
            'name' => 'Jannemijn',
            'email' => 'test@gmail.com',
            'admin' => 1
        ]);

        User::create([
            'password' => '$2y$12$Hyi1KiFQCgyUk8Cbe7XgCeFoNrea8sKRo2tOd6iO155hHJu1iPLi6',
            'name' => 'Jette',
            'email' => 'jette@gmail.com',
            'admin' => 0,
            'company_id' => 1
        ]);
    }
}
