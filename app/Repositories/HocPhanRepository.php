<?php

namespace App\Repositories;

use Exception;
use App\Models\HocPhan;
use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use App\Exceptions\InternalErrorException;
use App\SubActions\Common\UploadImageSubAction;


class HocPhanRepository extends BaseRepository
{
    protected $hocphan;

    public function __construct(HocPhan $hocphan)
    {
        $this->hocphan = $hocphan;
        parent::__construct($hocphan);
    }

    public function paginate($param = null)
    {
        $columns = [
            'hoc_phans.id',
            'hoc_phans.Ma_hp',
            'hoc_phans.Ten_hp',
            'hoc_phans.Ten_viet_tat',
            'hoc_phans.hinh_thuc_hoc',
            'hoc_phans.Thuc_tap',
            'hoc_phans.So_tc',
            'hoc_phans.Ma_khoa',
            'hoc_phans.level',
            'hoc_phans.orderBy',
        ];
        
        $hocphan = $this->hocphan->when(function($query) use($param){
            if ((isset($param['search']) && $param['search'])) {
                $query->where('hoc_phans.Ma_hp', 'like', "%" . $param['search'] . "%")
                    ->orWhere('hoc_phans.Ten_hp', 'like', "%" . $param['search'] . "%");
            }
            return $query;
        });
        $hocphan->orderBy($param['sortfield'], $param['sorttype']);
        return $hocphan->paginate($param['limit'], $columns);
    }

    public function getAll()
    {
    }

    public function create($request)
    {
        $data = $request->all();
        $maxOrderBy = HocPhan::max('orderBy');
        $data['orderBy'] = $maxOrderBy ? $maxOrderBy + 1 : 1;
        return $this->hocphan->create($data);
    }

    public function getById($id){
        try {
            $hocphan = $this->hocphan->find($id);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $hocphan;
    }

    public function update($request, $id){
        $hocphan = $this->hocphan->find($id);
        $data = $request->all();
        $data['Thuc_tap'] = isset($data['thuctap']) ? 1 : 0;
        if ($hocphan) {
            $hocphan->update($data);
        }
        return $hocphan;
    }

    public function nameExists($request)
    {
        $tenhocphan = $request->Ten_hp;
        $id = $request->id;

        return $this->hocphan->when(function ($query) use ($tenhocphan, $id) {
            $query->where("Ten_hp", $tenhocphan);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }   
            return $query;
        })->exists();
    }
}
