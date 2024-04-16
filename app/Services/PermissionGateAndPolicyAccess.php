<?php 

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Roles;
use App\Models\Category;
use App\Models\LopHocPhan;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\LopHocPhanPolicy;
use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess{

    public function setGateAndPolicyAccess(){
        $this->defineGateUser();
        $this->defineGateRole();
        $this->defineGateCateogry();
        $this->defineLopHocPhan();
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

    public function defineLopHocPhan(){
        Gate::define(LopHocPhan::LIST, [LopHocPhanPolicy::class, 'view']);
        Gate::define(LopHocPhan::CREATE, [LopHocPhanPolicy::class, 'create']);
        Gate::define(LopHocPhan::UPDATE, [LopHocPhanPolicy::class, 'update']);
        Gate::define(LopHocPhan::DELETE, [LopHocPhanPolicy::class, 'delete']);
    }
}