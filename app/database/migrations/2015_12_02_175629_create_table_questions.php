<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuestions extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('question_id');
            $table->string('question_name')->nullable()->default("NULL");
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->index('exam_id'); //maybe
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
        Schema::drop('questions');
    }

}
