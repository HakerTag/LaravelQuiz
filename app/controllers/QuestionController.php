<?php

class QuestionController extends \BaseController
{
    /**
     * CSRF protection
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store','destroy','update']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($examId)
    {
        $exam = Exam::findOrFail($examId);
        $exam->questions_count++;
        $exam->save();

        $question = new Question;
        $question->question_name = NULL;
        $question->user_id = Auth::user()->user_id;
        $question->exam_id = $examId;
        $question->save();

        for ($i = 1; $i <= 4; $i++) {
            $answer = new Answer;
            $answer->answer_name = NULL;
            $answer->correct_answer = "false";
            $answer->question_id = $question->question_id;

            $answer->user_id = Auth::user()->user_id;
            $answer->exam_id = $exam->exam_id;
            $answer->save();
        }

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
        $questions = $exam->questions()->get();
        $answers = Answer::where('exam_id', '=', $examId)->get();
        return View::make('questions.edit_questions', compact('exam', 'questions', 'answers'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update()
    {
        $data = Input::all();
        foreach (array_combine($data['question_id'], $data['question_name']) as $question_id => $question_name) {
            $question = Question::find($question_id);
            $question->question_name = $question_name;
            $question->save();
        }

        Flash::success('The question has been successfully updated!');
        return Redirect::action('AnswerController@edit', $question->exam_id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($questionId)
    {
            $question = Question::findOrFail($questionId);

            $exam = Exam::findOrFail($question->exam_id);
            $exam->questions_count--;
            $exam->save();

            Question::destroy($questionId);
    }

}
