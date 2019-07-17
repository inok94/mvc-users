<?php
return [
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],
    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
    ],

    'user/list/{page:\d+}' => [
        'controller' => 'user',
        'action' => 'list',
    ],
    'user/edit/{id:\d+}' => [
        'controller' => 'user',
        'action' => 'edit',
    ],
    'user/delete/{id:\d+}' => [
        'controller' => 'user',
        'action' => 'delete',
    ],
    'user/password/edit/user={id:\d+}' => [
        'controller' => 'user',
        'action' => 'password',
    ],
];