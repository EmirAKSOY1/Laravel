<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_disability', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_ID');
            $table->unsignedBigInteger('disability_ID');
            $table->foreign('question_ID')->references('question_id')->on('questions')->onDelete('cascade');
            $table->foreign('disability_ID')->references('id')->on('disabilities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_disability');
    }
};
