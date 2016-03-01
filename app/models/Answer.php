<?php

class Answer extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'answers';
    protected $primaryKey = 'answer_id';
    protected $fillable=[
        'answer_id',
        'answer_name',
        'user_id',
        'correct_answer',
        'exam_id',
        'question_id',
    ];


    public static $rules = array(
        'answer_name' => 'required|min:2|max:255',
    );

    public function question(){
        return $this->belongsTo('Question');
    }

}