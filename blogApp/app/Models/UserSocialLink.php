<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialLink extends Model
{
    protected $fillable = [
        'fb_url',
        'insta_url',
        'github_url',
    ];
}
