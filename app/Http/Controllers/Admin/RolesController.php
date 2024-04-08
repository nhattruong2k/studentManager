<?php

namespace App\Http\Controllers\Admin;

use App\Models\Roles;
use App\Libs\Constants;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\DeleteModelTrait;
use App\Http\Controllers\Controller;
use App\Repositories\RolesRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\CheckExistRoleNameRepository;
use App\Http\Requests\Roles\RolesRequest;

class RolesController extends Controller
{
    use DeleteModelTrait;

    protected $rolesRepository;
    protected $permissionsRepository;
    protected $checkExistRoleNameRepository;
    protected $_userRole;
    protected $_role;

    public function __construct(
        RolesRepository $rolesRepository,
        PermissionsRepository $permissionsRepository,
        CheckExistRoleNameRepository $checkExistRoleNameRepository,
        UserRole $_userRole,
        Roles $role,

    ) {
        $this->rolesRepository = $rolesRepository;
        $this->permissionsRepository = $permissionsRepository;
        $this->checkExistRoleNameRepository = $checkExistRoleNameRepository;
        $this->_userRole = $_userRole;
        $this->_role = $role;
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
        $this->data['title'] = __('roles.list');
        $roles = $this->rolesRepository->paginate($param);
        $this->data['roles'] = $roles;
        return view('admin.roles.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Roles();
        $this->data['title'] = __('roles.create');
        $this->data['role'] = $role;
        $permissions = $this->permissionsRepository->getAll();
        $this->data['permissions'] = $permissions;
        return view('admin.roles.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        $this->rolesRepository->create($request);
        return redirect(route(Roles::LIST));
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
        $this->data['title'] = __('roles.edit');
        $role = $this->rolesRepository->getById($id);
        $permissionsChecked = $role->permissions;
        $permissions = $this->permissionsRepository->getAll();
        $this->data['permissions'] = $permissions;
        $this->data['role'] = $role;
        $this->data['permissionsChecked'] = $permissionsChecked;

        return view('admin.roles.edit')->with($this->data)->with(['code' => Response::HTTP_OK, 'message' => __('roles.update')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request, $id)
    {
        $role = $this->rolesRepository->getById($id);
        $request['is_visible'] = !empty($request['is_visible']) ? $request['is_visible'] : 0;
        $this->rolesRepository->update($request, $id);
        $role->permissions()->sync($request->permission_id);
        notify()->success(trans('roles.update_successfully'));
        return redirect(route(Roles::LIST));
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
        $checkExist = $this->_userRole->whereIn('role_id', $arr_ids)->count();
        if ($checkExist === 0) {
            $this->deleteModelTrait($this->_role, $ids);
            notify()->success(trans('roles.delete_successfully'));
            return redirect()->back();
        }
        notify()->error(trans('roles.exist_users'));
        return redirect()->back();
    }

    public function nameExist(Request $request)
    {
        $name = trim($request->get("name"));
        $id = trim($request->get("id"));
        $result = $this->checkExistRoleNameRepository->run($name, $id);
        if ($result) {
            return response()->json(false);
        };
        return response()->json(true);
    }

    public function active(Request $request)
    {
        $id = trim($request->get("id"));
        $role = $this->rolesRepository->getById($id);
        $is_visible = $role->is_visible == Constants::$is_visible['active'] ? Constants::$is_visible['deactive'] : Constants::$is_visible['active'];
        $request = [
            'is_visible' => $is_visible,
        ];
        $this->rolesRepository->active(collect($request),  $id);
        return response()->json(["code" => Response::HTTP_OK, "message" => __('roles.status_successfully')]);
    }
}
