<?php

return [
    'title'       => 'Contact us',
    'email'       => 'E-Mail',
    'name'        => 'Name',
    'subject'     => 'Subject',
    'content'     => 'Content',
    'submit'      => 'Send',
    'validations' => [
        'email_required'   => 'Provide a valid email address',
        'email_email'      => 'Provide a valid email address',
        'name_required'    => 'Provide a name',
        'name_min'         => 'Name must be at least 2 chars',
        'subject_required' => 'Provide a subject',
        'content_required' => 'Content cannot be empty',
        'content_min'      => 'Content must be at least 10 chars',
    ],
];