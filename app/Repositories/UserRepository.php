<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\InternalErrorException;
use App\SubActions\Common\UploadImageSubAction;
use App\Exceptions\NotFoundException;

class UserRepository extends BaseRepository
{
    protected $user;
    protected $role;

    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct($user);
    }

    public function getAll($request = null)
    {
        return $this->user->get();
    }

    public function paginate($param = null)
    {
        $columns = [
            'users.id',
            'users.name',
            'users.avatar',
            'users.email',
            'users.is_visible',
        ];
        $users = $this->user->when(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('users.name', 'like', "%" . $param['search'] . "%")
                    ->orWhere('users.email', 'like', "%" . $param['search'] . "%");
            }
            if (!empty($param['is_visible'])) {
                $query->where('users.is_visible', $param['is_visible']);
            }
            return $query;
        });
        $users->orderBy($param['sortfield'], $param['sorttype']);
        return $users->paginate($param['limit'], $columns);
    }

    public function create($request)
    {
        $data = $request->all();
        unset($data['role_id']);
        if ($request->hasFile('avatar')) {
            $this->handleUploadAvatar($request->file('avatar'), $data);
        }
        $data['password'] = bcrypt($data['password']);
        $user = $this->user->create($data);
        $user->roles()->attach($request->role_id);
        return $user;
    }


    public function getById($id)
    {
        try {
            $role = $this->user->find($id);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $role;
    }

    public function update($request, $id)
    {
        $user = $this->user->find($id);
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $this->handleUploadAvatar($request->file('avatar'), $data);
        } else {
            if ($data['remove_img'] == true) {
                $data['avatar'] = '';
            }
        }

        if ($request->role_id) {
            $user->roles()->sync($request->role_id);
        }

        if ($user) {
            return $user->update($request->all());
        }

        return $user;
    }

    public function active($request, $id)
    {
        $user = $this->user->find($id);
        if ($user) {
            return $user->update($request->all());
        }
    }

    private function handleUploadAvatar($file, array &$data)
    {
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['name'], User::FOLDER_IMAGES);
        if (!empty($filename)) {
            $data['avatar'] = $filename;
        }
    }

    public function createUserPermission($request, $id)
    {
        $user = $this->user->find($id);
        if ($user) {
            $user->permissions()->sync($request->permission_id);
        }
        return $user;
    }

    public function nameExists($request)
    {
        $userName = $request->name;
        $id = $request->id;
        return $this->user->when(function ($query) use ($userName, $id) {
            $query = $this->user->whereUsername($userName);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }

    public function emailExists($request){
        $email = $request->name;
        $id = $request->id;
        return $this->user->when(function ($query) use ($email, $id) {
            $query = $this->user->whereEmail($email);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
