<?php

return [

    'title' => 'Subjects',
    'single' => 'Subjects',
    'model' => 'Subject',

    'columns' => [
        'subject_id' => [
            'title' => 'ID'
        ],
        'subject_name' => [
            'title' => 'Subject Name',
        ],
        'created_at',
    ],

    'edit_fields' => [
        'subject_name' => [
            'title' => 'Subject Name',
            'type' => 'text'
        ],
    ],

    'filters' => [
        'subject_id' => [
            'title' => 'Subject ID',
        ],
        'subject_name' => [
            'title' => 'Subject Name',
        ],
    ],
];
