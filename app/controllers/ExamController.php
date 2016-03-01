<?php

class ExamController extends \BaseController
{
    /**
     * CSRF protection
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index($examId)
    {
        $marks = DB::table('marks')
            ->where('exam_id', '=', $examId)
            ->where('user_id', '=', Auth::user()->user_id)
            ->get();

        if ($marks) {
            Flash::error('You have done this exam already');
            return Redirect::back();
        }
        return View::make('exams.start_exam');
    }


    /**
     * Getting the exam: questions and answers , sending them via json to SlickQuiz.js
     * @param $examId
     * @return json
     */
    public function getQuiz($examId)
    {
        $exam = Exam::findOrFail($examId);
        $questions = $exam->questions()->get();
        $answers = Answer::where('exam_id', '=', $examId)->get();
        $data = array(
            "info" => array(
                "name" => $exam->exam_name,
                "main" => "Good Luck!",
                "results" => "Good Try :)",
                "level1" => "Excellent 6",
                "level2" => "Very Good 5",
                "level3" => "Good 4",
                "level4" => "Middle 3",
                "level5" => "Poor 2"
            ),

        );
        for ($i = 0; $i < $exam->questions_count; $i++) {
            $data['questions'][]['q'] = $questions[$i]->question_name;
            for ($z = 0; $z < count($answers); $z++) {
                if ($answers[$z]->question_id == $questions[$i]->question_id) {
                    $data['questions'][$i]['a'][$z]['option'] = $answers[$z]->answer_name;
                    if ($answers[$z]->correct_answer == "true") {
                        $data['questions'][$i]['a'][$z]['correct'] = true;
                    } else {
                        $data['questions'][$i]['a'][$z]['correct'] = false;
                    }
                }
            }
        }
        return Response::json($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $subjects = DB::table('subjects')->get();
        return View::make('exams.create_edit', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(Input::all(), Exam::$create_rules);
        if ($validator->fails()) {
            return Redirect::to('exam/create')->withInput()->withErrors($validator);
        }
        $data = Input::all();

        //creating the exam
        $exam = new Exam;
        $exam->exam_name = $data['exam_name'];
        $exam->exam_time = $data['questions_count'] * $data['time_per_question'];
        $exam->questions_count = $data['questions_count'];
        $exam->time_per_question = $data['time_per_question'];
        $exam->teacher_id = Auth::user()->user_id;
        $exam->subject_id = $data['subject'];
        $exam->save();

        //adding questions
        for ($i = 1; $i <= $data['questions_count']; $i++) {
            $question = new Question;
            $question->question_name = NULL;
            $question->user_id = Auth::user()->user_id;
            $question->exam_id = $exam->exam_id;
            $question->save();
        }

        //adding answers for each question
        $answers = $data['questions_count'] * 4;
        $questionLastID = $question->question_id + 1; //for ID 0
        $questionFirstID = $questionLastID - $data['questions_count'];

        //counter for updating question id every 4 answers
        $count = 0;

        for ($i = 1; $i <= $answers; $i++) {
            $answer = new Answer;
            $answer->answer_name = NULL;
            $answer->correct_answer = "false";
            $answer->question_id = $questionFirstID;
            $count++;

            if ($count % 4 == 0) {
                $questionFirstID++;
            }

            $answer->user_id = Auth::user()->user_id;
            $answer->exam_id = $exam->exam_id;
            $answer->save();
        }

        Flash::success('The exam has been successfully created!');
        return Redirect::to('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function showAllExamsToSpecTeacher($teacherId)
    {
        $exams = Exam::where('teacher_id', '=', $teacherId)->get();
        return View::make('exams.show_all_exams_to_spec_teacher', compact('exams'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($examId)
    {
        $exam = Exam::findOrFail($examId);
        $this->authorOrAdminPermissionRequire($exam->teacher_id);

        $subjects = DB::table('subjects')
            ->select('subject_id', 'subject_name')
            ->orderBy('created_at')
            ->get();
        $exam = Exam::findOrFail($examId);
        $current_subject = $exam->subject()->get();
        return View::make('exams.create_edit', compact('exam', 'subjects', 'current_subject'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($examId)
    {
        $exam = Exam::findOrFail($examId);
        $this->authorOrAdminPermissionRequire($exam->teacher_id);

        $data = Input::all();

        $validator = Validator::make($data, Exam::$update_rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $exam = Exam::findOrFail($examId);
        $exam->exam_name = $data['exam_name'];
        $exam->subject_id = $data['subject'];

        $exam->update();

        Flash::success('The exam has been successfully updated!');
        return Redirect::to('/');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($examId)
    {
        $exam = Exam::findOrFail($examId);
        $this->authorOrAdminPermissionRequire($exam->teacher_id);
        Exam::destroy($examId);
    }
}
