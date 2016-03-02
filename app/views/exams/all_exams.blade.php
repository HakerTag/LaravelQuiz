@extends('..._layouts.default.index')

@section('title')
    Home @parent
@stop

@section('content')
    <section id="section-banner">
       <h1>All exams</h1>
    </section>

    @include('flash::message')

    <section id="section-all-exams">
        @foreach($subjects as $subject)
            <h3>{{{$subject->subject_name}}}</h3>
            <ul class="clearfix">
                @foreach($exams as $exam)
                         @if($exam->subject_id==$subject->subject_id)
                             <li value="{{{$exam->exam_id}}}"  title="Click to start">
                                   {{--{{ link_to_route('startExam', $exam->exam_name, $exam->exam_id)}}--}}
                                   <div class="exam-name">{{{$exam->exam_name}}}</div>
                                   <div class="questions-count">Questions: <span class="white-atr">{{{$exam->questions_count}}}</span></div>
                                   @foreach($marks as $mark)
                                       @if($exam->exam_id==$mark->exam_id)
                                            <div class="finished-exam">You have done this exam.<span class="white-atr">Mark: {{{$mark->mark}}}</span></div>
                                        @endif
                                   @endforeach
                             </li>
                         @endif
                @endforeach
            </ul>
        @endforeach
    </section>
    <script>
        $(document).ready(function () {
            $("#section-all-exams li").hover(
              function() {
                $(this).children(".questions-count").toggle();
                $(this).children(".finished-exam").toggle();
              }
            );

            $('li').click(function(){
                window.location = ("exam/")+$(this).attr('value');
            });
        });
    </script>
@stop
