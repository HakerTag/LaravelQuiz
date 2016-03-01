<?php

class SubjectController extends \BaseController
{
    /**
     * CSRF protection
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('subjects/create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), Subject::$rules);

        if ($validator->fails()) {
            return Redirect::to('subject/create')->withErrors($validator);
        } else {
            $subject = new Subject;
            $subject->subject_name = Input::get('subject_name');
            $subject->user_id = Auth::user()->user_id;
            $subject->save();

            Flash::success('The subject has been successfully created!');
            return Redirect::to('/');
        }
    }



}
