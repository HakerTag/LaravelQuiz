<?php

return [

    'title' => 'Answers',
    'single' => 'Answers',
    'model' => 'Answer',

    'columns' => [
        'answer_id' => [
            'title' => 'ID'
        ],
        'answer_name' => [
            'title' => 'Answer Name',
        ],
        'created_at',
    ],

    'edit_fields' => [
       'answer_name' => [
            'title' => 'Answer Name',
            'type' => 'text'
        ],
    ],

    'filters' => [
        'answer_id' => [
            'title' => 'Answer ID',
        ],
        'answer_name' => [
            'title' => 'Answer Name',
        ],
    ],
];
