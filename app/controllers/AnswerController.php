<?php

class AnswerController extends \BaseController
{
    /**
     * CSRF protection
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store($questionId)
    {
        $question = Question::findOrFail($questionId);

        $answer = new Answer;
        $answer->answer_name = NULL;
        $answer->correct_answer = "false";
        $answer->question_id = $question->question_id;

        $answer->user_id = Auth::user()->user_id;
        $answer->exam_id = $question->exam_id;
        $answer->save();

        Flash::success('The answer has been successfully added!');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $examId
     * @return Response
     */
    public function edit($examId)
    {
        $exam = Exam::findOrFail($examId);
        $this->authorOrAdminPermissionRequire($exam->teacher_id);
        $questions = $exam->questions()->get();
        $answers = Answer::where('exam_id', '=', $examId)->get();
        return View::make('answers.edit_answers', compact('exam', 'questions', 'answers'));
    }


    /**
     * Update the specified resource in storage.
     *
     */
    public function update()
    {
        $data = Input::all();
        $this->authorOrAdminPermissionRequire($data['teacher_id']);
        foreach (array_combine($data['answer_id'], $data['answer_name']) as $answer_id => $answer_name) {
            $answer = Answer::find($answer_id);
            $answer->answer_name = $answer_name;
            $answer->save();

            if (isset($data['correct_answer'])) {
                foreach ($data['answer_id'] as $answer_id) {
                    $answer = Answer::find($answer_id);
                    $answer->correct_answer = "false";
                    $answer->save();
                }
                foreach ($data['correct_answer'] as $correct_answer_id) {
                    $answer = Answer::find($correct_answer_id);
                    $answer->correct_answer = "true";
                    $answer->save();
                }
            }
        }

        Flash::success('The answers has been successfully updated!');
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($answerId)
    {
        if (Request::ajax()) {
            $answer = Answer::findOrFail($answerId);
            $this->authorOrAdminPermissionRequire($answer->user_id);
            Answer::destroy($answerId);
        }
    }

}
