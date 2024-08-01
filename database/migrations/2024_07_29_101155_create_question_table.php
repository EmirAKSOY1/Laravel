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
        Schema::create('questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->string('common_text')->nullable();//Zorunlu değil
            $table->string('root_text');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c')->nullable();//Zorunlu değil
            $table->string('option_d')->nullable();//Zorunlu değil
            $table->string('option_e')->nullable();//Zorunlu değil
            $table->char('option_true',1);//doğru seçenek tek bir harf olacağı için
            $table->float('parameter_a');
            $table->float('parameter_b')->nullable();
            $table->float('parameter_c')->nullable();
            $table->float('parameter_d')->nullable();
            $table->float('use_rate')->nullable();
            $table->unsignedBigInteger('learning_out_comes');
            $table->unsignedBigInteger('cognitive_id');
            $table->boolean('is_active')->default(true); //varsayılan olarak true
            $table->boolean('text_synthesize');
            $table->boolean('try_question')->default(false);
            $table->char('module',1)->nullable();//doğru seçenek tek bir harf olacağı için
            $table->foreign('learning_out_comes')->references('learning_outcomes_id')->on('learning_outcomes')->onDelete('cascade');
            $table->foreign('cognitive_id')->references('id')->on('cognitive')->onDelete('cascade');
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
        Schema::dropIfExists('questions');
    }
};
