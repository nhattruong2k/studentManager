<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LopHocPhanPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.lop_hoc_phans.list'));
    }

    public function create()
    {
        return checkPermission(config('permission.access.lop_hoc_phans.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.lop_hoc_phans.update'));
    }

    public function delete()
    {
        return checkPermission(config('permission.access.lop_hoc_phans.delete'));
    }
}
