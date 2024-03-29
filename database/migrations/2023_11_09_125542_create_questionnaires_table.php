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
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('completed_times')->default(0);
            $table->unsignedBigInteger('deceased_id')->nullable();
            $table->foreign('deceased_id')->references('id')->on('deceaseds');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->nullable();
            $table->timestamp('expire')->nullable();
            $table->string('customer_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};
