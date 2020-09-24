<?php

// Functions common for ALL project


if (!function_exists('getConfig')) {
    function getConfig($key, $default = '')
    {
        return config('config.' . $key, $default);
    }
}

if (!function_exists('getConstant')) {
    function getConstant($key, $default = '')
    {
        return config('constant.' . $key, $default);
    }
}