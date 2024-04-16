<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;
use App\Models\Category;
use App\Models\LopHocPhan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            
            // Roles
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

            // Category
            [
                'name' => 'Danh mục',
                'type' => 'group',
                'key_code' => 'categories',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'categories',
                'key_code' => Category::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'categories',
                'key_code' => Category::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'categories',
                'key_code' => Category::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'categories',
                'key_code' => Category::DELETE,
            ],

            // Lop Hoc Phan
            [
                'name' => 'Lớp học phần',
                'type' => 'group',
                'key_code' => 'lop_hoc_phans',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'lop_hoc_phans',
                'key_code' => LopHocPhan::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'lop_hoc_phans',
                'key_code' => LopHocPhan::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'lop_hoc_phans',
                'key_code' => LopHocPhan::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'lop_hoc_phans',
                'key_code' => LopHocPhan::DELETE,
            ],
        ];
        \DB::table('permissions')->insert($permissions);
    }
}
