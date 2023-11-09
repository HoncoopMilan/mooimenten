<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questionnaire_question', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('question_id')->references('id')->on('questions');
            $table->foreignId('questionnaires_id')->references('id')->on('questionnaires');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaire_question');
    }
};
