<?php

namespace App\Models\Entities;

use App\Models\Base\ApiToken;
use App\Models\Entities\Base\BaseModel;

class Admin extends BaseModel
{
    use ApiToken;

    protected $table = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['adminUserName', 'adminEmail', 'adminPassword', 'adminAvatar', 'adminRoleType', 'accessToken'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
