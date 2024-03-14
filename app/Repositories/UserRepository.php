<?php
namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\InternalErrorException;
use App\SubActions\Common\UploadImageSubAction;

class UserRepository extends BaseRepository
{
    protected $user;
    protected $role;

    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct($user);
    }

    public function getAll($request = null){
        return $this->user->get();
    }

    public function create($request){
        $data = $request->all();
        if($request->hasFile('avatar')){
            $this->handleUploadAvatar($request->file('avatar'), $data);
        }
        $data['password'] = bcrypt($data['password']);
        return $this->user->create($data);
    }

    private function handleUploadAvatar($file, array &$data){
        $filename = resolve(UploadImageSubAction::class)->run($file, $data['name'], User::FOLDER_IMAGES);
        if(!empty($filename)) {
            $data['avatar'] = $filename;
        }
    }
}