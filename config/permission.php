<?php

use App\Models\User;
use App\Models\Roles;
use App\Models\Category;
use App\Models\LopHocPhan;

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
        'lop_hoc_phans' => [
            'list' => LopHocPhan::LIST,
            'create' => LopHocPhan::CREATE,
            'update' => LopHocPhan::UPDATE,
            'delete' => LopHocPhan::DELETE,
        ]
    ]
];