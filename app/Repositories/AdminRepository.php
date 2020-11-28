<?php

namespace App\Repositories;

use App\Models\Entities\Admin;
use App\Repositories\Base\BaseRepository;

class AdminRepository extends BaseRepository
{
    function model()
    {
        return Admin::class;
    }

    public function validator()
    {
        return \App\Validators\Admin::class;
    }
}
