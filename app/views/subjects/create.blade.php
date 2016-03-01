@extends('_layouts/default/index')

@section('title')
    Create Subject @parent
@stop

@section('content')
    <section id="section-banner">
        <h1>Creating a new subject</h1>
    </section>

    @include('_layouts.default.partials.errors')

    <section class="section-form">
        {{Form::open(array('action' => 'storeSubject', 'method'=>'post'))}}
            {{Form::label('subject_name', 'Name of the subject:')}}
            {{Form::text('subject_name')}}

            {{Form::submit('Add',array('class'=>'button'))}}

        {{ Form::close() }}
    </section>
@stop