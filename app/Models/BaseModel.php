<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseModel extends Authenticatable
{
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'ins_date';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'upd_date';
}
