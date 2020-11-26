<?php

// Functions common for ALL project


use Illuminate\Support\Facades\Auth;

if (!function_exists('getConfig')) {
    function getConfig($key, $default = '')
    {
        return config('config.' . $key, $default);
    }
}

if (!function_exists('getBackendConfig')) {
    function getBackendConfig($key, $default = '')
    {
        return config('config.backend.' . $key, $default);
    }
}

if (!function_exists('getFrontendConfig')) {
    function getFrontendConfig($key, $default = '')
    {
        return config('config.frontend.' . $key, $default);
    }
}

if (!function_exists('getSystemConfig')) {
    function getSystemConfig($key, $default = '')
    {
        return config('systems.' . $key, $default);
    }
}

if (!function_exists('getConstant')) {
    function getConstant($key, $default = '')
    {
        return config('constant.' . $key, $default);
    }
}


if (!function_exists('toSql')) {

    function toSql($query)
    {
        return sql_binding($query->toSql(), $query->getBindings());
    }
}

if (!function_exists('sql_binding')) {

    function sql_binding($sql, $bindings)
    {
        $boundSql = str_replace(['%', '?'], ['%%', '%s'], $sql);
        foreach ($bindings as &$binding) {
            if ($binding instanceof \DateTime) {
                $binding = $binding->format('\'Y-m-d H:i:s\'');
            } elseif (is_string($binding)) {
                $binding = "'$binding'";
            }
        }
        $boundSql = vsprintf($boundSql, $bindings);
        return $boundSql;
    }
}

if (!function_exists('transMessage')) {
    function transMessage($key, $default = '')
    {
        return empty(trans('messages.' . $key)) ? $default : trans('messages.' . $key);
    }
}

if (!function_exists('arrayGet')) {
    function arrayGet($arr = [], $key, $default = '')
    {
        if (!is_array($arr) || empty($arr[$key])) {
            return '';
        }

        return $arr[$key];
    }
}

if (!function_exists('adminGuard')) {
    function adminGuard()
    {
        return Auth::guard('admins');
    }
}

if (!function_exists('isBackendArea')) {
    function isBackendArea()
    {
        return request()->is(getConstant('BACKEND_ALIAS'), getConstant('BACKEND_ALIAS') . '/*');
    }
}
