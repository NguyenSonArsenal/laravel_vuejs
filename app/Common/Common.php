<?php

// Functions common for ALL project


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

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
    function arrayGet($arr = [], $key, $default = null)
    {
        if (!is_array($arr) || empty($arr[$key])) {
            return $default;
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

// ========== API AUTHENTICATION ==========
if (!function_exists('apiGuard')) {

    function apiGuard($default = 'api')
    {
        return Auth::guard(getSystemConfig('api_guard', $default));
    }
}

/**
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 * Get the currently authenticated user...
 * Lấy thông tin user đã đăng nhập
 */
if (!function_exists('apiGetCurrentUser')) {
    function apiGetCurrentUser()
    {
        return apiGuard()->user();
    }
}

/**
 * @return string
 * Get the currently authenticated user's ID...
 * Lấy id của user đã đăng nhập
 */
if (!function_exists('apiGetCurrentUserId')) {
    function apiGetCurrentUserId()
    {
        $current = apiGuard()->user();
        return !empty($current) ? $current->id : '';
    }
}


/**
 * @return bool
 * The user is logged in...
 * Xác định user đã login chưa
 */
if (!function_exists('apiIsLogged')) {
    function apiIsLogged()
    {
        return apiGuard()->check();
    }
}
// ========== END API AUTHENTICATION ==========

if (!function_exists('forgetCookie')) {
    function forgetCookie($name)
    {
        return \Cookie::queue(\Cookie::forget($name));
    }
}

if (!function_exists('getCookie')) {
    function getCookie($cookieName = '', $default = null)
    {
        // get all cookie
        if (empty($cookieName)) {
            return request()->cookie();
        }

        return request()->cookie($cookieName) ? request()->cookie($cookieName) : $default;
    }
}

if (!function_exists('getMyCookie')) {
    function getMyCookie($name, Request $request){
        $value = $request->cookie($name);
        echo $value;
    }
}

if (!function_exists('setMyCookie')) {
    function setMyCookie($name, $value, $minutes)
    {
        Cookie::queue(Cookie::make($name, $value, $minutes));
    }
}

// Mã hóa
if (!function_exists('myEncrypt')) {
    function myEncrypt($string, $key)
    {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keyChar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keyChar));
            $result .= $char;
        }

        return base64_encode($result);
    }
}

// Giải mã
if (!function_exists('myDecrypt')) {
    function myDecrypt($string, $key)
    {
        $result = '';
        $string = base64_decode($string);

        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keyChar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keyChar));
            $result .= $char;
        }

        return $result;
    }
}
