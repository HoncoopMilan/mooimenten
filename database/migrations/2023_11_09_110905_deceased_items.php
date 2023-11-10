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
        Schema::create('deceaseds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('zipcode');
            $table->string('city');
            $table->string('adress');
            $table->date('date_of_birth');
            $table->date('date_of_death');
            $table->string('img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
