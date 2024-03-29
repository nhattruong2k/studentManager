<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserRole.
 *
 * @package namespace App\Models;
 */
class UserRole extends Model 
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "user_roles";
    protected $fillable = [
        'role_id',
        'user_id',
    ];

}