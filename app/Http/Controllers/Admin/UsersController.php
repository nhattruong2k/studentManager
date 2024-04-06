<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Libs\Constants;
use App\Models\UserRole;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Http\Response;
use App\Traits\DeleteModelTrait;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\RolesRepository;
use App\Repositories\PermissionsRepository;
use App\Http\Requests\User\UserRequest;

class UsersController extends Controller
{
    use DeleteModelTrait;

    protected $userRepository;
    protected $rolesRepository;
    protected $_userRole;
    protected $users;
    protected $permissionsRepository;
    
    public function __construct(
        UserRepository $userRepository,
        RolesRepository $rolesRepository,
        UserRole $_userRole,
        User $users,
        PermissionsRepository $permissionsRepository,
    ) {
        $this->userRepository = $userRepository;
        $this->rolesRepository = $rolesRepository;
        $this->_userRole = $_userRole;
        $this->users = $users;
        $this->permissionsRepository = $permissionsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $param = array(
            'limit' => 10,
            'sortfield' => 'id',
            'sorttype' => 'DESC'
        );

        if ($request->has('sortfield') && $request->has('sorttype')) {
            $param['sortfield'] = $request->get('sortfield');
            $param['sorttype'] = $request->get('sorttype');
        }

        if ($request->has('search')) {
            $param['search'] = $request->get('search');
        }

        if ($request->has('numpaging') && $request->get('numpaging') > 0) {
            $param['limit'] = $request->get('numpaging');
        }

        $users = $this->userRepository->paginate($param);
        $this->data['title'] = __('users.list');
        $this->data['users'] = $users;
        return view('admin.users.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $roles = $this->rolesRepository->getAll();
        $this->data['title'] = __('users.create');
        $this->data['user'] = $user;
        $this->data['roles'] = $roles;
        return view('admin.users.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->userRepository->create($request);
        return redirect(route(User::LIST));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        $roles = $this->rolesRepository->getAll();
        $roleOfUser = $user->roles;
        $this->data['title'] = __('users.edit');
        $this->data['user'] = $user;
        $this->data['roles'] = $roles;
        $this->data['roleOfUser'] = $roleOfUser;
        return view('admin.users.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $user = $this->userRepository->getById($id);
        $request['is_visible'] = !empty($request['is_visible']) ? $request['is_visible'] : 0;
        $this->userRepository->update($request, $id);
        notify()->success(trans('users.update_successfully'));
        return redirect(route(User::LIST));
    }


    public function active(Request $request)
    {
        $id = trim($request->get("id"));
        $user = $this->userRepository->getById($id);
        $is_visible = $user->is_visible == Constants::$is_visible['active'] ? Constants::$is_visible['deactive'] : Constants::$is_visible['active'];
        $request = [
            'is_visible' => $is_visible,
        ];
        $this->userRepository->active(collect($request),  $id);
        return response()->json(["code" => Response::HTTP_OK, "message" => __('users.status_successfully')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('id');
        $arr_ids = explode(",", $ids);
        $this->deleteModelTrait($this->users, $ids);
        $this->_userRole->whereIn('user_id', $arr_ids)->delete();
        notify()->success(trans('users.delete_successfully'));
        return redirect()->back();
    }

    public function profile()
    {
        $auth_id = Auth::user()->id;
        $user = $this->userRepository->getById($auth_id);
        $roles = $this->rolesRepository->getAll();
        $roleOfUser = $user->roles;
        $this->data['title'] = __('users.profile');
        $this->data['user'] = $user;
        $this->data['roles'] = $roles;
        $this->data['roleOfUser'] = $roleOfUser;
        return view('admin.users.profile')->with($this->data);
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $request['is_visible'] = !empty($request['is_visible']) ? $request['is_visible'] : 0;
        $this->userRepository->update($request, $id);
        notify()->success(trans('users.update_profile_successfully'));
        return redirect(route(User::LIST));
    }

    public function changePassword()
    {
        $auth_id = Auth::user()->id;
        $title = __('users.change_password');
        $user = $this->userRepository->getById($auth_id);
        $this->data['title'] = $title;
        $this->data['user'] = $user;
        return view('admin.users.auth_change_password')->with($this->data);
    }

    public function saveChangePassword(Request $request)
    {
        $data = $request->all();
        $currentPassword = Auth::User()->password;
        if (Hash::check($data['old_password'], $currentPassword)) {
            $userId = Auth::User()->id;
            $objUser = $this->userRepository->getById($userId);
            $objUser->password = bcrypt($data['new_password']);
            $objUser->save();
            notify()->success(trans('users.change_pass_success'));
            return redirect()->back();
        } else {
            notify()->error(trans('users.old_pass_not_is_correct'));
            return redirect()->back();
        }
        return redirect(route('changePassword'));
    }

    public function userChangePass($id)
    {
        $title = __('users.change_password');
        $user = $this->userRepository->getById($id);
        $this->data['title'] = $title;
        $this->data['user'] = $user;
        return view('admin.users.change_password')->with($this->data);
    }

    public function saveUserChangePass(Request $request, $id)
    {
        $user = $this->userRepository->getById($id);
        if ($user) {
            $data['password'] = bcrypt($request->get('new_password'));
            $user->update($data);
            notify()->success(trans('users.change_pass_success'));
            return redirect(route(User::LIST));
        }
        notify()->error(trans('users.change_pass_fail'));
        return redirect(route(User::LIST));
    }

    public function permission($id)
    {
        $user = $this->userRepository->getById($id);
        $permissions = $this->permissionsRepository->getAll();
        $permissionsRoleChecked = $this->rolesRepository->getPermissionRoleUserId($id);
        $permissionUserChecked = $user->permissions;
        $this->data['title'] = __('users.permission');
        $this->data['user'] = $user;
        $this->data['permissions'] = $permissions;
        $this->data['permissionsRoleChecked'] = $permissionsRoleChecked;
        $this->data['permissionUserChecked'] = $permissionUserChecked;
        // dd($this->data);
        return view('admin.users.permission')->with($this->data);
    }

    public function savePermission(Request $request, $id)
    {
        $this->userRepository->createUserPermission($request, $id);
        notify()->success(trans('users.create_permission_successfully'));
        return redirect(route(User::LIST));
    }

    public function nameExists(Request $request){
        $result = $this->userRepository->nameExists($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function emailExists(Request $request){
        $result = $this->userRepository->emailExists($request);
        if($result){
            return response()->json(false);
        };
        return response()->json(true);
    }
}
