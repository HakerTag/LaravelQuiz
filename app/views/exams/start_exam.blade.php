@extends('_layouts/default/index')

@section('title')
    Start Exam @parent
@stop

@section('specific-page-addons')
          <script src="{{asset('js/slickQuiz.js')}}"></script>
@stop
@section('content')

    <section id="section-banner">
       <h1>Start exam</h1>
    </section>
    <section id="start-exam-container">
        <button id="start-button">Start Exam</button>

        <div class="quizName"><!-- where the quiz name goes --></div>

        <body id="slickQuiz">

        <div class="quizArea">
            <div class="quizHeader">
                <!-- where the quiz main copy goes -->

                <a class="button startQuiz" href="#">Get Started!</a>
            </div>

            <!-- where the quiz gets built -->
        </div>

        <div class="quizResults">
            <h3 class="quizScore">You Scored: <span><!-- where the quiz score goes --></span></h3>

            <h3 class="quizLevel"><strong>Ranking:</strong> <span><!-- where the quiz ranking level goes --></span></h3>

            <div class="quizResultsCopy">
                <!-- where the quiz result copy goes -->
            </div>
        </div>
        </body>

    </section>
    
    <script>
    $(document).ready(function () {
        $('#start-button').click(load);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });

    function load() {
        $('#start-button').hide();

        var getQuizUrl = $(location).attr('href'); //getting the url with a specific quiz
        $.ajax({
            method: "POST",
            url: getQuizUrl

        }).done(function (data) {
                $('#slickQuiz').slickQuiz({
                    json: data,
                    perQuestionResponseMessaging: false,
                    skipStartButton: true,
                    preventUnanswered: true
                });
            }
        );


    }
    </script>
@stop
