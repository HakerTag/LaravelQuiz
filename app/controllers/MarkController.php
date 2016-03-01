<?php

class MarkController extends \BaseController
{
    /**
     * CSRF protection
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store']]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($examId, $mark)
    {
        if (normalUser()) {
            $m = new Mark;
            $m->mark = $mark;
            $m->exam_id = $examId;
            $m->user_id = Auth::user()->user_id;
            $m->save();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function showToUser($userId)
    {
        checkUserAuthor($userId);
        $marks = DB::table('marks')
            ->leftJoin('exams', 'marks.exam_id', '=', 'exams.exam_id')
            ->select('marks.created_at', 'marks.mark', 'exams.exam_name')
            ->where('user_id', '=', $userId)
            ->get();
        return View::make('marks.marks_to_user', compact('marks'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function showToTeacher($teacherId)
    {
        checkUserAuthor($teacherId);
        $marks = DB::table('exams')
            ->leftJoin('marks', 'marks.exam_id', '=', 'exams.exam_id')
            ->leftJoin('users', 'users.user_id', '=', 'marks.user_id')
            ->leftJoin('subjects', 'subjects.subject_id', '=', 'exams.subject_id')
            ->select('users.fname', 'users.lname', 'users.email', 'users.faculty_number', 'subjects.subject_name', 'exams.exam_name', 'marks.mark', 'marks.created_at')
            ->where('teacher_id', '=', $teacherId)
            ->get();
        return View::make('marks.marks_to_teacher', compact('marks'));

    }


}
