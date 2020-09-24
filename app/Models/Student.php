<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'students';

    protected $fillable = [
        'full_name',
        'address',
        'gender',
        'phone_number',
        'date_of_birth',
    ];

    public $timestamps = false;
}
