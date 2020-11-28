<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class Admin extends BaseValidator
{
    // ========== API AREA ==========
    public function apiValidatePostLogin($params = [])
    {
        $rules = [
            'adminEmail' => 'required|email|string|max:255',
            'adminPassword' => 'required|string|min:8'
        ];

        return $this->validate($rules, $params);
    }
    // ========== END API AREA ==========
}
