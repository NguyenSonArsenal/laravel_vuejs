<?php

if (!defined('GENDER_BOY')) define('GENDER_BOY', 1);
if (!defined('GENDER_GIRL')) define('GENDER_GIRL', 2);

return [
    'backend' => [
        'pagination' => [
            'perPage' => 20
        ],
    ],
    'database' => [
        'gender' => [
            GENDER_BOY => ['id' => GENDER_BOY, 'name' => 'Nam'],
            GENDER_GIRL => ['id' => GENDER_GIRL, 'name' => 'Nữ']
        ]
    ],
    'del_flag' => [
        'on' => 0,
        'off' => 1
    ],
    'common' => [
        'status' => [
            'active' => ['id' => 1, 'alias' => 'Hoạt động'],
            'disabled' => ['id' => 2, 'alias' => 'Vô hiệu hóa'],
//            'waiting_active' => ['id' => 3, 'alias' => 'Chờ kích hoạt']
        ]
    ],

    'user' => [
        'userStatus' => [
            'active' => 1,
            'disabled' => 2,
//            'waiting_active' => 3,
        ],
        'userGender' => [
            'boy' => 1,
            'girl' => 2
        ]
    ],
];
