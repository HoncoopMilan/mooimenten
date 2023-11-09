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
        Schema::create('_question_list__question', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('question_id')->references('id')->on('questions');
            $table->foreignId('questionsList_id')->references('id')->on('questions_list');
            $table->foreignId('deceased_id')->references('id')->on('deceased');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_question_list__question');
    }
};
