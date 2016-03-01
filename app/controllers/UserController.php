<?php

class UserController extends \BaseController
{
    /**
     * CSRF protection
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['login', 'create']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::check()) {
            $subjects = DB::table('subjects')
                ->select('subject_id', 'subject_name')
                ->orderBy('created_at')
                ->get();
            $exams = DB::table('exams')
                ->select('exam_id', 'exam_name', 'teacher_id', 'subject_id', 'questions_count')
                ->orderBy('created_at')
                ->get();

            $marks = DB::table('marks')
                ->select('marks.mark', 'marks.exam_id')
                ->where('user_id', '=', Auth::user()->user_id)
                ->get();
            return View::make('exams.all_exams', compact('subjects', 'exams','marks'));
        }
        return View::make('_layouts.default.guest_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $validator = Validator::make(Input::all(), User::$rulesSignUp);
        if ($validator->fails()) {
            return Redirect::to('/')->withInput(Input::except('password', 'password_confirmation'))->withErrors($validator);
        } else {
            $data = Input::all();
            $user = new User;
            $user->fname = $data['fname'];
            $user->lname = $data['lname'];
            $user->email = $data['email'];
            $user->faculty_number = $data['faculty_number'];
            $user->password = Hash::make($data['password']);
            $user->remember_token = $data['_token'];
            $user->save();

            Flash::success('Your account has been successfully created!');
            return Redirect::back();
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function login()
    {
        $validator = Validator::make(Input::all(), User::$rulesLogIn);
        if ($validator->fails()) {
            return Redirect::to('/')->withInput(Input::except('password'))->withErrors($validator);
        } else {
            $data = Input::all(); //only username and password
            //username
            if (Auth::attempt(array('email' => $data['email'], 'password' => $data['password']))) {
                return Redirect::to('/');
            } else {
                Flash::warning('Wrong username/password.');
                return Redirect::back();
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        Flash::success('You have been logged out.');
        return Redirect::to('/');
    }

}
