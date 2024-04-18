<?php

namespace App\Http\Controllers\Admin;

use App\Models\HocPhan;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;
use App\Http\Controllers\Controller;
use App\Repositories\HocPhanRepository;
use Response;
use App\Http\Requests\HocPhan\HocPhanRequest;

class HocPhanController extends Controller
{

    use DeleteModelTrait;

    protected $hocphanRepository;
    protected $_hocPhan;

    public function __construct(HocPhanRepository $hocphanRepository, HocPhan $_hocPhan)
    {
        $this->hocphanRepository = $hocphanRepository;
        $this->_hocPhan = $_hocPhan;
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

        $hocphans = $this->hocphanRepository->paginate($param);
        $this->data['title'] = __('hocphan.list');
        $this->data['hocphans'] = $hocphans;
        return view('admin.hocphan.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hocphan = new HocPhan();
        $this->data['hocphan'] = $hocphan;
        $this->data['title'] = __('hocphan.create');
        return view('admin.hocphan.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HocPhanRequest $request)
    {
        $this->hocphanRepository->create($request);
        notify()->success(trans('hocPhan.create_successfully'));
        return redirect(route(HocPhan::LIST));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HocPhan  $HocPhan
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HocPhan  $HocPhan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hocphan = $this->hocphanRepository->getById($id);
        $this->data['hocphan'] = $hocphan;
        $this->data['title'] = __('hocphan.edit');
        return view('admin.hocphan.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HocPhan  $hocPhan
     * @return \Illuminate\Http\Response
     */
    public function update(HocPhanRequest $request, $id)
    {
        $this->hocphanRepository->getById($id);
        $this->hocphanRepository->update($request, $id);
        notify()->success(trans('hocPhan.update_successfully'));
        return redirect(route(HocPhan::LIST));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HocPhan  $hocPhan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $this->deleteModelTrait($this->_hocPhan, $id);
        notify()->success((trans('hocPhan.delete_successfully')));
        return redirect()->back();
    }

    public function nameExist(Request $request)
    {
        $result = $this->hocphanRepository->nameExists($request);
        if ($result) {
            return response()->json(false);
        }
        return response()->json(true);
    }
}
