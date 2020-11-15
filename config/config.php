<?php

return [
    'backend' => [
        'pagination' => [
            'perPage' => 20
        ],
    ],
    'database' => [
        'gender' => [
            'boy' => ['id' => 1, 'alias' => 'Nam'],
            'girl' => ['id' => 2, 'alias' => 'Nữ']
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
