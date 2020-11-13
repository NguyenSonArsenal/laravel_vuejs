<?php

namespace App\Repositories;

use App\Models\Entities\User;
use App\Repositories\Base\BaseRepository;

class UserRepository extends BaseRepository
{
    function model()
    {
        return User::class;
    }

    public function validator()
    {
        return \App\Validators\User::class;
    }
}
