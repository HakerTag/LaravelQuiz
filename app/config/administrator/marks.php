<?php

return [

    'title' => 'Marks',
    'single' => 'Marks',
    'model' => 'Mark',

    'columns' => [
        'mark_id' => [
            'title' => 'ID'
        ],
        'mark' => [
            'title' => 'Mark',
        ],
        'user_id' => [
            'title' => 'user ID',
        ],
        'created_at',
    ],

    'edit_fields' => [
        'mark' => [
            'title' => 'mark',
            'type' => 'text'
        ],

    ],

    'filters' => [
        'mark_id' => [
            'title' => 'ID'
        ],
        'mark' => [
            'title' => 'Mark',
        ],
        'user_id' => [
            'title' => 'user ID',
        ]
    ],
];
