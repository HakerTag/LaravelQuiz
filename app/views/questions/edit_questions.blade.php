@extends('_layouts/default/index')

@section('title')
    Edit Questions @parent
@stop

@section('content')
    <section id="section-banner">
       <h1>Editing questions</h1>
    </section>

    <div class="exam-info">
        <p>
        Exam name:<span class="exam-atr">{{{$exam->exam_name}}}</span> Questions :<span class="exam-atr">{{{$exam->questions_count}}}</span>
        Exam time :<span class="exam-atr">{{{$exam->exam_time}}} minutes</span> Created at :<span class="exam-atr"> {{{$exam->created_at}}}</span>
        </p>
    </div>

    <section id="section-question-form">

    <button value="{{$exam->exam_id}}" class="button-add-more-question">Add more questions</button>

    {{Form::open(array('action' => 'updateQuestions','method'=>'patch'))}}

        {{ Form::hidden('questions_count', $exam->questions_count) }}
        {{ Form::hidden('exam_id', $exam->exam_id) }}

        @foreach($questions as $question)
            <div class="single-q clearfix">
                <button value="{{$question->question_id}}" class="button-remove">Remove</button>
                <input type="text" placeholder="Question name" name="question_name[]" value="{{{$question->question_name}}}">
                <input type="hidden" name="question_id[]" value="{{{$question->question_id}}}">
            </div>
        @endforeach

        {{Form::submit('Save Questions',array('class'=>'button-save-question'))}}
     {{ Form::close() }}

    </section>

    <script>
            $('.button-remove').click(function(e){
                e.preventDefault();
//                var thisDiv=$(this);
                $.ajax({
                     method: 'DELETE',
                     url: '{{ url('question/delete') }}' + '/' + $(this).attr('value'),
                     success: function() {
//                   thisDiv.parent().css("display","none");
                        location.reload();
                    }
                });
            });

            $('.button-add-more-question').click(function(){

                $.ajax({
                     method: "POST",
                     url: '{{ url('question/add') }}' + '/' + $(this).attr('value'),
                     success: function(){
                         location.reload();
                     }
                });
            });
    </script>
@stop
