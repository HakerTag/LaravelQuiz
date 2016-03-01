@extends('_layouts/default/index')

@section('title')
    @if(isset($exam))
         Edit Exam
    @else
         Create Exam
    @endif
    @parent
@stop

@section('content')
    <section id="section-banner">
        @if(isset($exam))
            <h1>Editing a exam</h1>
        @else
            <h1>Creating a new exam</h1>
        @endif
    </section>

@include('_layouts.default.partials.errors')
<section class="section-form clearfix">
    @if(isset($exam))
        {{Form::model($exam, array('action' => ['updateExam', $exam->exam_id], 'method'=>'patch'))}}
    @else
        {{Form::open(array('action' => 'storeExam', 'method'=>'post'))}}
    @endif
        <div class="form-column">
            {{Form::label('exam_name', 'Exam name:') }}
            {{Form::text('exam_name')}}

            @if(!isset($exam))
                {{ Form::label('questions_count', 'How many questions?') }}
                {{ Form::text('questions_count',  isset($exam) ? $exam->questions_count :'10', array('class' => 'questionsCount')) }}

            {{ Form::label('time_per_question', 'Time per question(minutes):') }}
            {{ Form::text('time_per_question',  isset($exam) ? $exam->time_per_question : '1', array('class' => 'timePerQuestion')) }}
            @endif
            {{ Form::label('subject', 'Select a subject:') }}
            <select name="subject">
                @if(isset($exam)) <option value="{{{$current_subject[0]->subject_id}}}" selected>{{{$current_subject[0]->subject_name}}}</option> @endif
                    @foreach($subjects as $subject)
                       <option value="{{{$subject->subject_id}}}">{{{$subject->subject_name}}}</option>
                    @endforeach
            </select>
        </div>
        @if(isset($exam))
            {{Form::submit('Update',array('class'=>'button'))}}
        @else
            {{Form::submit('Add',array('class'=>'button'))}}
        @endif

    {{ Form::close() }}
</section>
@stop