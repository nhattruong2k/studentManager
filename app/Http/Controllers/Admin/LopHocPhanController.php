<?php

namespace App\Http\Controllers\Admin;

use App\Models\LopHocPhan;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;
use App\Http\Controllers\Controller;
use App\Repositories\LopHocPhanRepository;
use Response;
use App\Http\Requests\LopHocPhan\LopHocPhanRequest;

class LopHocPhanController extends Controller
{

    use DeleteModelTrait;

    protected $lophocphanRepository;
    protected $_lopHocPhan;

    public function __construct(LopHocPhanRepository $lophocphanRepository, LopHocPhan $_lopHocPhan)
    {
        $this->lophocphanRepository = $lophocphanRepository;
        $this->_lopHocPhan = $_lopHocPhan;
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

        $lophocphans = $this->lophocphanRepository->paginate($param);
        $this->data['title'] = __('lophocphan.list');
        $this->data['lophocphans'] = $lophocphans;
        return view('admin.lophocphan.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lophocphan = new LopHocPhan();
        $this->data['lophocphan'] = $lophocphan;
        $this->data['title'] = __('lophocphan.create');
        return view('admin.lophocphan.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LopHocPhanRequest $request)
    {
        $this->lophocphanRepository->create($request);
        return redirect(route(LopHocPhan::LIST));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LopHocPhan  $lopHocPhan
     * @return \Illuminate\Http\Response
     */
    public function show(LopHocPhan $lopHocPhan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LopHocPhan  $lopHocPhan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lophocphan = $this->lophocphanRepository->getById($id);
        $this->data['lophocphan'] = $lophocphan;
        $this->data['title'] = __('lophocphan.edit');
        return view('admin.lophocphan.edit')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LopHocPhan  $lopHocPhan
     * @return \Illuminate\Http\Response
     */
    public function update(LopHocPhanRequest $request, $id)
    {
        $this->lophocphanRepository->getById($id);
        $this->lophocphanRepository->update($request, $id);
        notify()->success(trans('lophocphan.update_successfully'));
        return redirect(route(LopHocPhan::LIST));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LopHocPhan  $lopHocPhan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $this->deleteModelTrait($this->_lopHocPhan, $id);
        notify()->success((trans('lophocphan.delete_successfully')));
        return redirect()->back();
    }

    public function nameExist(Request $request)
    {
        $result = $this->lophocphanRepository->nameExists($request);
        if ($result) {
            return response()->json(false);
        }
        return response()->json(true);
    }
}
