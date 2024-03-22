<?php


namespace App\Repositories;

use App\Models\Roles;
use App\Repositories\Contracts\RolesRepository;

class CheckExistRoleNameRepository extends BaseRepository
{
    protected $roles;

    public function __construct(Roles $roles)
    {
        $this->roles = $roles;
    }

    public function run($name, $id = null)
    {        
        $query = $this->roles->whereName($name);
        if (!empty($id)) {
            $query = $query->where('id', '!=', $id);
        }
        return $query->exists();
    }
}
