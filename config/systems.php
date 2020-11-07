<?php

return [
    // auth
    'backend_alias' => env('BACKEND_ALIAS', 'admin'),
    'frontend_alias' => env('FRONTEND_ALIAS', 'admin'),

    'created_at_column' => 'ins_date',
    'updated_at_column' => 'upd_date',
    'deleted_at_column' => 'del_flag',
    'created_by_column' => 'ins_id',
    'updated_by_column' => 'upd_id',

    'status_code_500' => 500,
    'status_code_200' => 200,
    'status_code_404' => 404,

    'sql_log' => env('HAS_LOG_SQL', true),
];
