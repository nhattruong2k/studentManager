<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class HocPhanPolicy
{
    use HandlesAuthorization;

    public function view()
    {
        return checkPermission(config('permission.access.hoc_phans.list'));
    }

    public function create()
    {
        return checkPermission(config('permission.access.hoc_phans.create'));
    }

    public function update()
    {
        return checkPermission(config('permission.access.hoc_phans.update'));
    }

    public function delete()
    {
        return checkPermission(config('permission.access.hoc_phans.delete'));
    }
}
