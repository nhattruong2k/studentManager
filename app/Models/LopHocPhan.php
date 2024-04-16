<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LopHocPhan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "lop_hoc_phans";

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const LIST = 'danh_sach_lop_hoc_phan';
    const CREATE = 'them_lop_hoc_phan';
    const UPDATE = 'cap_nhat_lop_hoc_phan';
    const DELETE = 'xoa_lop_hoc_phan';
 
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Ma_hp',
        'Ten_hp',
        'Ten_viet_tat',
        'hinh_thuc_hoc',
        'Thuc_tap',
        'So_tc',
        'Ma_khoa',
        'level',
        'orderBy',
    ];
}
