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
        Schema::create('test_sub_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('test_id')->unsigned();
            $table->bigInteger('sub_branch_id')->unsigned();
            $table->timestamps();

            $table->foreign('test_id')->references('test_id')->on('tests')->onDelete('cascade');
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
        Schema::dropIfExists('test_sub_branches');
    }
};
