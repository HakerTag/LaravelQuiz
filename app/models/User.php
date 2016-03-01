<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable=[
        'user_id',
        'username',
        'email',
        'faculty_number',
        'status',
        'password',
        'remember_token',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public static $rulesSignUp = array(
        'fname' => 'required|min:2|max:255|string',
        'lname' => 'required|min:2|max:255|string',
        'email' => 'required|min:2|max:255|email|unique:users,email',
        'faculty_number' => 'required|integer|numeric|unique:users,faculty_number|digits:10',
        'password' => 'required|min:2|max:120',
        'password_confirmation' => 'required|same:password',
    );

    public static $rulesLogIn = array(
        'email' => 'required|max:255|string',
        'password' => 'required|max:120',
    );

    public function exams(){
        return $this->hasMany('Exam');
    }

    public function subjects(){
        return $this->hasMany('Subject');
    }
}