@extends('_layouts/default/index')

@section('title')
    My Exams @parent
@stop

@section('content')
    <section id="section-banner">
       <h1>My exams</h1>
    </section>

    @include('flash::message')
    @if (!isset($exams[0]))
       <div id="empty-data">You don't have any exams yet.</div>
    @else
    <section id="section-show-exam">
        @foreach($exams as $exam)
        <div class="single-exam">
            <h3>{{$exam->exam_name}}</h3>
            {{ link_to_route('editAnswers', 'Preview', $exam->exam_id, array('class' => 'button-preview')) }}
            {{ link_to_route('editExam', 'Edit Exam', $exam->exam_id, array('class' => 'button-edit')) }}
            {{ link_to_route('editQuestions', 'Edit Questions', $exam->exam_id, array('class' => 'button-edit')) }}
            {{ link_to_route('editAnswers', 'Edit Answers', $exam->exam_id, array('class' => 'button-edit')) }}
            <button class="button-remove" value="{{$exam->exam_id}}" >Remove</button>
        </div>
        @endforeach
    </section>
    @endif

    <script>
        $('.button-remove').click(function(){
            $.ajax({
                 method: "DELETE",
                 url: '{{ url('/exam') }}' + '/' + $(this).attr('value'),
                 success:
                     $(this).parent().css("display", "none")
            })
        });

    </script>
@stop