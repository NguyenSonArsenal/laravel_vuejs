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
            'userName' => 'required|max:64',
            'userPhone' => ['bail', 'required', 'regex:/^(84|0[1|8|9])([0-9]{8,9})$/', 'unique:users,userPhone'],
            'userEmail' => 'bail|required|email|max:64|unique:users,userEmail',
        ];

        return $this->validate($rules, $params);
    }

    /**
     * @param array $params
     * @return bool
     * Backend validate store product
     */
    public function backendValidateUpdateUser($params = [])
    {
        $rules = [
            'userName' => 'required|max:64',
            'userPhone' => ['bail', 'required', 'regex:/^(84|0[1|8|9])([0-9]{8,9})$/', 'unique:users,userPhone,' . arrayGet($params, 'id')],
            'userEmail' => 'bail|required|email|max:64|unique:users,userEmail, '  . arrayGet($params, 'id'),
        ];

        return $this->validate($rules, $params);
    }
    // ========== END BACKEND AREA ==========

    protected function _setCustomAttributes()
    {
        return [
            'userName' => 'Tên đầy đủ',
            'userPhone' => 'SĐT',
            'userEmail' => 'Email',
        ];
    }

    protected function _setCustomMessage()
    {
        $message['userPhone.regex'] = 'Vui lòng nhập trường SĐT bắt đầu với 01, 08 hoặc 09 và là những số và có độ dài 10 hoặc 11 kí tự';
        return $message;
    }
}
