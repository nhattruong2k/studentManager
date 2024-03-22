<?php 

namespace App\Services;
use App\Models\User;
use App\Models\Role;
use App\Models\Roles;
use Illuminate\Support\Facades\Gate;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;

class PermissionGateAndPolicyAccess{

    public function setGateAndPolicyAccess(){
        $this->defineGateUser();
        $this->defineGateRole();
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
}