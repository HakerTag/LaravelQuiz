<?php

class Subject extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subjects';
    protected $primaryKey = 'subject_id';
    protected $fillable = [
        'subject_id',
        'subject_name',
        'user_id',
    ];

    public static $rules = array(
        'subject_name' => 'required|min:2|max:255|unique:subjects,subject_name',
    );

    public function exams()
    {
        return $this->hasMany('Exam');
    }

}