<?php

return [

    'title' => 'Questions',
    'single' => 'Questions',
    'model' => 'Question',

    'columns' => [
        'question_id' => [
            'title' => 'ID'
        ],
        'question_name' => [
            'title' => 'Question Name',
        ],
        'exam_id' => [
            'title' => 'Exam ID',
        ],
        'created_at',
    ],

    'edit_fields' => [
        'question_name' => [
            'title' => 'User Name',
            'type' => 'text'
        ],
    ],

    'filters' => [
        'question_id' => [
            'title' => 'Question ID',
        ],
        'question_name' => [
            'title' => 'Question Name',
        ],

    ],
];
