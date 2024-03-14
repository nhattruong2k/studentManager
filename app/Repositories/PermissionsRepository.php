<?php
namespace App\Repositories;

use App\Models\Permissions;
use Illuminate\Http\Request;
use App\Exceptions\InternalErrorException;
use App\SubActions\Common\UploadImageSubAction;

class PermissionsRepository extends BaseRepository
{
    protected $permissions;

    public function __construct(Permissions $permissions)
    {
        $this->permissions = $permissions;
        parent::__construct($permissions);
    }

    public function getAll(){
        return $this->permissions->whereType('group')->get('*' );
    }

    // public function create($request = null){
    //     return $this->permissions->whereType('group')->get('*' );
    // }
}