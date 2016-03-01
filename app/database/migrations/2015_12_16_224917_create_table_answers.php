<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAnswers extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('answer_id');
            $table->string('answer_name')->nullable()->default("NULL");
            $table->integer('user_id')->unsigned();
            $table->string('correct_answer')->default("false");
            $table->integer('exam_id')->unsigned();
            $table->integer('question_id')->unsigned();
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
        Schema::drop('answers');
    }

}
