<?php

use App\Models\User;
use App\Models\Roles;

return [
    'access' => [
        'users' => [
            'list'   => User::LIST,
            'create' => User::CREATE,
            'update' => User::UPDATE,
            'delete' => User::DELETE,
        ],
        'roles' => [
            'list'   => Roles::LIST,
            'create' => Roles::CREATE,
            'update' => Roles::UPDATE,
            'delete' => Roles::DELETE,
        ]
    ]
];