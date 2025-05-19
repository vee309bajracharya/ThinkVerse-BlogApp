<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\UserStatus;
use App\UserType;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'picture',
        'bio',
        'type',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays and JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'type'=> UserType::class,
        'status' => UserStatus::class,
    ];

    public function getPictureAttribute($value)
    {
        return $value ? asset('/images/users/' . $value) : asset('/images/users/default_user.png');
    }
    
}
