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
        Schema::create('learning_outcomes', function (Blueprint $table) {
            $table->id('learning_outcomes_id');
            $table->string('learning_outcomes_name');
            $table->unsignedBigInteger('sub_branch_id');
            $table->timestamps();

            $table->foreign('sub_branch_id')->references('sub_branch_id')->on('sub_branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_outcomes');
    }
};
