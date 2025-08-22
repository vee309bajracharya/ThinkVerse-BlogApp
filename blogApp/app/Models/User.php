<?php

namespace App\Models;

use App\UserType;
use App\UserStatus;
use App\Models\UserSocialLink;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function social_links(){
        return $this->belongsTo(UserSocialLink::class, 'id', 'user_id');
    }
    
    public function posts(){
        return $this->hasMany(Post::class, 'author_id','id');
    }
}
