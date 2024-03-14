<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\InternalErrorException;
use App\Models\Roles;
use App\SubActions\Common\UploadImageSubAction;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RolesRepository extends BaseRepository
{
    protected $roles;

    public function __construct(Roles $roles)
    {
        $this->roles = $roles;
        parent::__construct($roles);
    }

    public function getAll($columns = ['*']){
        return $this->roles->active()->select($columns)->get();
    }

    public function paginate($param = null)
    {
        $columns = [
            'roles.id',
            'roles.name',
            'roles.description',
            'roles.is_visible',
        ];
        $roles = $this->roles->when(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('roles.name', 'like', "%" . $param['search'] . "%");
            }
            if (!empty($param['is_visible'])) {
                $query->where('roles.is_visible', $param['is_visible']);
            }
            return $query;
        });
        $roles->orderBy($param['sortfield'], $param['sorttype']);
        return $roles->paginate($param['limit'], $columns);
    }

    public function create($request)
    {
        $data = $request->all();
        unset($data['permission_id']);
        $role = $this->roles->create($data);
        $role->permissions()->attach($request->permission_id);
        return $role;
    }

    public function getById($id)
    {
        try {
            $role = $this->roles->find($id);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $role;
    }

    public function update($request, $id)
    {  
        $role = $this->roles->find($id);
        if ($role) {
            return $role->update($request->all());
        }
    }
}
