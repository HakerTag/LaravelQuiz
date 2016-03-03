<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::post('user/create', [
    'as' => 'signup',
    'uses' => 'UserController@create'
]);

Route::post('user/login', [
    'as' => 'login',
    'uses' => 'UserController@login'
]);

Route::get('/', [
    'as' => 'home',
    'uses' => 'UserController@index'
]);

Route::pattern('id', '[0-9]+');
Route::pattern('mark', '[2-6]');

Route::group(array('before' => 'auth'), function () {

    Route::get('user/logout', [
        'as' => 'logout',
        'uses' => 'UserController@logout'
    ]);

    //----EXAM ROUTES-----
    Route::get('exam/{id}', [
        'as' => 'startExam',
        'uses' => 'ExamController@index'
    ]);
    Route::post('exam/{id}', [
        'as' => 'quiz',
        'uses' => 'ExamController@getQuiz',
    ]);

    //----EXAM ROUTES END-----

    //----MARKS ROUTES----
    Route::get('marks/{id}', [
        'as' => 'showMarksUser',
        'uses' => 'MarkController@showToUser'
    ]);
    Route::post('exam/{id}/mark/{mark}', [
        'as' => 'saveMark',
        'uses' => 'MarkController@store'
    ]);
    //----END MARKS-----

    Route::group(array('before' => 'auth_teacher_and_admin'), function () {
        //----MARKS ROUTES----
        Route::get('classbook/{id}', [
            'as' => 'showMarksTeacher',
            'uses' => 'MarkController@showToTeacher'
        ]);
        //----END MARKS-----

        //----EXAM ROUTES-----
        Route::get('exam/create', [
            'as' => 'createExam',
            'uses' => 'ExamController@create'
        ]);


        Route::post('exam/create', [
            'as' => 'storeExam',
            'uses' => 'ExamController@store'
        ]);

        Route::get('exam/{id}/edit', [
            'as' => 'editExam',
            'uses' => 'ExamController@edit'
        ]);

        Route::get('exam/user/{id}', [
            'as' => 'showAllExamsToSpecTeacher',
            'uses' => 'ExamController@showAllExamsToSpecTeacher'
        ]);

        Route::patch('exam/{id}', [
            'as' => 'updateExam',
            'uses' => 'ExamController@update'
        ]);

        Route::delete('exam/{id}', [
            'as' => 'deleteExam',
            'uses' => 'ExamController@destroy'
        ]);
        //----EXAM ROUTES END-----

        //----QUESTION ROUTES-----
        Route::post('question/add/{id}', [
            'as' => 'addMoreQuestions',
            'uses' => 'QuestionController@store'
        ]);
        Route::get('question/{id}/edit', [
            'as' => 'editQuestions',
            'uses' => 'QuestionController@edit'
        ]);
        Route::patch('question/update', [
            'as' => 'updateQuestions',
            'uses' => 'QuestionController@update'
        ]);
        Route::delete('question/delete/{id}', [
            'as' => 'deleteQuestion',
            'uses' => 'QuestionController@destroy'
        ]);
        //----QUESTION ROUTES END-----

        //----ANSWER ROUTES-----
        Route::post('answer/update', [
            'as' => 'updateAnswers',
            'uses' => 'AnswerController@update'
        ]);

        Route::delete('answer/delete/{id}', [
            'as' => 'deleteAnswer',
            'uses' => 'AnswerController@destroy'
        ]);

        Route::get('answer/edit/{id}', [
            'as' => 'editAnswers',
            'uses' => 'AnswerController@edit'
        ]);

        Route::post('answer/add/{id}', [
            'as' => 'addAnswer',
            'uses' => 'AnswerController@store'
        ]);
        //----ANSWER ROUTES END-----

        //----SUBJECT ROUTES END-----
        Route::get('subject/create', [
            'as' => 'createSubject',
            'uses' => 'SubjectController@create'
        ]);

        Route::post('subject/create', [
            'as' => 'storeSubject',
            'uses' => 'SubjectController@store'
        ]);
        //----SUBJECT ROUTES END-----

    });//END ADMIN TEACHER FILTER




});//END LOGGED FILTER
