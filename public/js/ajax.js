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