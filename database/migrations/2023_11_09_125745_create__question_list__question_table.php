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
            $table->foreignId('Question_id')->references('id')->on('Question');
            $table->foreignId('QuestionList_id')->references('id')->on('QuestionList');
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
