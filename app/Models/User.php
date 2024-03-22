<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Libs\Constants;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table ='users';

    const LIST = 'user_list';
    const CREATE = 'user_create';
    const UPDATE = 'user_update';
    const DELETE = 'user_delete';

    const STORAGE_DISK= "images";
    const FOLDER_IMAGES= "users";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'facebook',
        'phone',
        'avatar',
        'address',
        'role',
        'day_of_birth',
        'gender',
        'password',
        'is_visible',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'avatar_urls',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'avatar_urls',
    ];
    
    public function getAvatarUrlAttribute()
    {
        if (empty($this->avatar)) {
            return asset('/images/default.jpg');
        }
        $path = sprintf(self::FOLDER_IMAGES);
        return Storage::disk(self::STORAGE_DISK)->url($path . '/' . $this->avatar);
    }
    
    const MALE = 1;
    const FEMALE = 0;
    
    public function genderOption()
    {
        return [
            self::MALE => __('users.male'),
            self::FEMALE => __('users.female'),
        ];
    }


    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'user_roles', 'user_id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'user_permissions', 'user_id', 'permission_id');
    }

    public function scopeNotAdministrator($query)
    {
        return $query->where('role', '<>', Constants::$administrator);
    }
}
