<?php

return [

    'title' => 'Exams',
    'single' => 'Exams',
    'model' => 'Exam',

    'columns' => [
        'exam_id' => [
            'title' => 'ID'
        ],
        'exam_name' => [
            'title' => 'Exam Name',
        ],
        'exam_time' => [
            'title' => 'Exam Time',
        ],
        'questions_count' => [
            'title' => 'Questions Count',
        ]
        ,
        'time_per_question' => [
            'title' => 'Time Per Question(min)',
        ],
        'teacher_id' => [
            'title' => 'Teacher ID',
        ],
        'created_at',
    ],

    'edit_fields' => [
        'exam_name' => [
            'title' => 'Exam Name',
            'type' => 'text',
        ],
        'questions_count' => [
            'title' => 'Questions Count',
            'type' => 'number',
        ],
        'time_per_question' => [
            'title' => 'Time Per Question(min)',
            'type' => 'number',
        ],
        'teacher_id' => [
            'title' => 'Teacher ID',
            'type' => 'number',
        ],

    ],

    'filters' => [
        'exam_id' => [
            'title' => 'Exam ID',
        ],
        'exam_name' => [
            'title' => 'Exam Name',
        ],
        'teacher_id' => [
            'title' => 'Teacher id',
        ],
    ],
    'rules' => [
        'exam_name' => 'required|min:2|max:52|unique:exams,exam_name',
        'questions_count' => 'required|integer|numeric|between:5,120',
        'time_per_question' => 'required|integer|numeric|between:1,20',
    ],
];
