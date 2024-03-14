<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions  = [
            [
                'name' => 'Người dùng',
                'type' => 'group',
                'key_code' => 'users',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'users',
                'key_code' => User::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'users',
                'key_code' => User::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'users',
                'key_code' => User::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'users',
                'key_code' => User::DELETE,
            ],
            [
                'name' => 'Vai trò',
                'type' => 'group',
                'key_code' => 'roles',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'roles',
                'key_code' => Roles::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'roles',
                'key_code' => Roles::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'roles',
                'key_code' => Roles::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'roles',
                'key_code' => Roles::DELETE,
            ],
        ];
        \DB::table('permissions')->insert($permissions);
    }
}
