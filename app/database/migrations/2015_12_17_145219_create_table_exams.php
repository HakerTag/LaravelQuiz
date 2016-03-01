<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExams extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('exam_id');
            $table->string('exam_name');
            $table->integer('exam_time')->unsigned();
            $table->tinyInteger('questions_count')->default(10)->unsigned();
            $table->tinyInteger('time_per_question')->default(1)->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('user_id')->on('users');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('subject_id')->on('subjects');
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
        Schema::drop('exams');
    }

}
