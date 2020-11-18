<?php

namespace App\Models\Entities\Base;

use App\Models\Scopes\Base\BaseScope;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseModel extends Authenticatable
{
    use BaseScope;

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
