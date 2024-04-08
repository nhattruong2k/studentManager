<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    const LIST = 'course_list';
    const CREATE = 'course_create';
    const UPDATE = 'course_update';
    const DELETE = 'course_delete';

    protected $table = 'courses';
    protected $fillable = [
        'id',
        'ma_khoa_hoc',
        'ten_khoa_hoc',
        'start_date',
        'end_date',
        'orderby',
        'create_by',
        'update_by'
    ];
}
