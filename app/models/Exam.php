<?php

class Exam extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exams';
    protected $primaryKey = 'exam_id';
    protected $fillable = [
        'exam_id',
        'exam_name',
        'exam_time',
        'questions_count',
        'time_per_question',
        'teacher_id',
        'subject_id	',
    ];


    public static $create_rules = array(
        'exam_name' => 'required|min:2|max:52|unique:exams,exam_name',
        'questions_count' => 'required|integer|numeric|between:5,120',
        'time_per_question' => 'required|integer|numeric|between:1,20',
    );
    public static $update_rules = array(
        'exam_name' => 'required|min:2|max:52|unique:exams,exam_name',
    );

    public function subject()
    {
        return $this->belongsTo('Subject');
    }

    public function questions()
    {
        return $this->hasMany('Question');
    }


}