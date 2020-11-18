<?php

namespace App\Models\Scopes\Base;

// Local scope
trait BaseScope {
    public function scopeWithActive($query)
    {
        return $query->where('del_flag', '=', getConstant('NOT_DELETE', 0))->orWhereNull('del_flag');
    }
}
