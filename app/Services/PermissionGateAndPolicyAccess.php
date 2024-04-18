<?php 

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Roles;
use App\Models\HocPhan;
use App\Models\Category;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\HocPhanPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess{

    public function setGateAndPolicyAccess(){
        $this->defineGateUser();
        $this->defineGateRole();
        $this->defineGateCateogry();
        $this->defineGateHocPhan();
    }

    public function defineGateUser(){
        Gate::define(User::LIST, [UserPolicy::class, 'view']);
        Gate::define(User::CREATE, [UserPolicy::class, 'create']);
        Gate::define(User::UPDATE, [UserPolicy::class, 'update']);
        Gate::define(User::DELETE, [UserPolicy::class, 'delete']);
    }

    public function defineGateRole(){
        Gate::define(Roles::LIST, [RolePolicy::class, 'view']);
        Gate::define(Roles::CREATE, [RolePolicy::class, 'create']);
        Gate::define(Roles::UPDATE, [RolePolicy::class, 'update']);
        Gate::define(Roles::DELETE, [RolePolicy::class, 'delete']);
    }

    public function defineGateCateogry(){
        Gate::define(Category::LIST, [CategoryPolicy::class, 'view']);
        Gate::define(Category::CREATE, [CategoryPolicy::class, 'create']);
        Gate::define(Category::UPDATE, [CategoryPolicy::class, 'update']);
        Gate::define(Category::DELETE, [CategoryPolicy::class, 'delete']);
    }

    public function defineGateHocPhan(){
        Gate::define(HocPhan::LIST, [HocPhanPolicy::class, 'view']);
        Gate::define(HocPhan::CREATE, [HocPhanPolicy::class, 'create']);
        Gate::define(HocPhan::UPDATE, [HocPhanPolicy::class, 'update']);
        Gate::define(HocPhan::DELETE, [HocPhanPolicy::class, 'delete']);
    }
}