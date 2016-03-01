<?php

class Question extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';
    protected $primaryKey = 'question_id';
    protected $fillable=[
        'question_id',
        'question_name',
        'user_id',
        'exam_id',
    ];

    public static $rules = array(
        'question_name' => 'required|min:2|max:255',
    );

    public function exam()
    {
        return $this->belongsTo('Exam');
    }

    public function answers(){
        return $this->hasMany('Answer');

    }

}