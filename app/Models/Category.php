<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const LIST = 'category_list';
    const CREATE = 'category_create';
    const UPDATE = 'category_update';
    const DELETE = 'category_delete';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'active'
    ];
}
