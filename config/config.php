<?php

return [
    'del_flag' => [
        'on' => 0,
        'off' => 1
    ],
    'pagination' => [
        'perPage' => 20
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
