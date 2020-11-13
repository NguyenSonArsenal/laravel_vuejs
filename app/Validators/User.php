<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class User extends BaseValidator
{
    // ========== BACKEND AREA ==========
    /**
     * @param array $params
     * @return bool
     * Backend validate store product
     */
    public function backendValidateStoreUser($params = [])
    {
        $rules = [
            'userName' => 'required',
            'userPhone' => 'bail|required',
            'userGender' => 'bail|required',
            'userAddress' => 'bail|required',
        ];

        return $this->validate($rules, $params);
    }
    // ========== END BACKEND AREA ==========
}
