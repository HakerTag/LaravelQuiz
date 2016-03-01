<?php

return [

    'title' => 'Users',
    'single' => 'Users',
    'model' => 'User',

    'columns' => [
        'user_id' => [
            'title' => 'ID'
        ],
        'fname' => [
            'title' => 'First Name',
        ],
        'lname' => [
            'title' => 'Last Name',
        ],
        'email' => [
            'title' => 'Email',
        ],
        'status' => [
            'title' => 'Status',
        ]
        ,'faculty_number' => [
            'title' => 'Faculty Number',
        ],
        'created_at',
    ],

    'edit_fields' => [
        'fname' => [
            'title' => 'First Name',
            'type' => 'text'

        ],
        'lname' => [
            'title' => 'First Name',
            'type' => 'text'

        ],
       'email' => [
            'title' => 'Email',
            'type' => 'text'
        ],
        'status' => [
            'title' => 'Status',
            'type' => 'number'
        ]
        ,'faculty_number' => [
            'title' => 'Faculty Number',
            'type' => 'number'
        ],

    ],

    'filters' => [
        'fname' => [
            'title' => 'First Name',
        ],
        'lname' => [
            'title' => 'Last Name',
        ],
        'username' => [
            'title' => 'User Name',
        ],
        'email' => [
            'title' => 'Email Adress',
        ],
        'status' => [
            'title' => 'Status',
        ],
        'faculty_number' => [
            'title' => 'Faculty Number',
        ],
    ],
];
