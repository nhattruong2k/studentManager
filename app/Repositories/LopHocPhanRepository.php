<?php

namespace App\Repositories;

use Exception;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;
use App\Exceptions\InternalErrorException;
use App\SubActions\Common\UploadImageSubAction;
use App\Exceptions\NotFoundException;


class LopHocPhanRepository extends BaseRepository
{
    protected $lophocphan;

    public function __construct(LopHocPhan $lophocphan)
    {
        $this->lophocphan = $lophocphan;
        parent::__construct($lophocphan);
    }

    public function paginate($param = null)
    {
        $columns = [
            'lop_hoc_phans.id',
            'lop_hoc_phans.Ma_hp',
            'lop_hoc_phans.Ten_hp',
            'lop_hoc_phans.Ten_viet_tat',
            'lop_hoc_phans.hinh_thuc_hoc',
            'lop_hoc_phans.Thuc_tap',
            'lop_hoc_phans.So_tc',
            'lop_hoc_phans.Ma_khoa',
            'lop_hoc_phans.level',
            'lop_hoc_phans.orderBy',
        ];
        
        $lophocphan = $this->lophocphan->when(function($query) use($param){
            if ((isset($param['search']) && $param['search'])) {
                $query->where('lop_hoc_phans.Ma_hp', 'like', "%" . $param['search'] . "%")
                    ->orWhere('lop_hoc_phans.Ten_hp', 'like', "%" . $param['search'] . "%");
            }
            return $query;
        });
        $lophocphan->orderBy($param['sortfield'], $param['sorttype']);
        return $lophocphan->paginate($param['limit'], $columns);
    }

    public function getAll()
    {
    }

    public function create($request)
    {
        $data = $request->all();
        $maxOrderBy = LopHocPhan::max('orderBy');
        $data['orderBy'] = $maxOrderBy ? $maxOrderBy + 1 : 1;
        return $this->lophocphan->create($data);
    }

    public function getById($id){
        try {
            $lophocphan = $this->lophocphan->find($id);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $lophocphan;
    }

    public function update($request, $id){
        $lophocphan = $this->lophocphan->find($id);
        $data = $request->all();
        $data['Thuc_tap'] = isset($data['thuctap']) ? 1 : 0;
        if ($lophocphan) {
            $lophocphan->update($data);
        }
        return $lophocphan;
    }

    public function nameExists($request)
    {
        $tenlophocphan = $request->Ten_hp;
        $id = $request->id;

        return $this->lophocphan->when(function ($query) use ($tenlophocphan, $id) {
            $query->where("Ten_hp", $tenlophocphan);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }   
            return $query;
        })->exists();
    }
}
