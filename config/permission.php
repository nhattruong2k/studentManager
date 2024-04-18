<?php

use App\Models\User;
use App\Models\Roles;
use App\Models\HocPhan;
use App\Models\Category;

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
        ],
        'categories' => [
            'list' => Category::LIST,
            'create' => Category::CREATE,
            'update' => Category::UPDATE,
            'delete' => Category::DELETE,
        ],
        'hoc_phans' => [
            'list' => HocPhan::LIST,
            'create' => HocPhan::CREATE,
            'update' => HocPhan::UPDATE,
            'delete' => HocPhan::DELETE,
        ]
    ]
];