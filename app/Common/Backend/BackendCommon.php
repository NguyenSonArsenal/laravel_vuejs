<?php

// Functions common for backend project

if (!function_exists('getCurrentAdminId')) {
    function getCurrentAdminId()
    {
        return getCurrentAdminEntity()->id;
    }
}

if (!function_exists('getCurrentAdminName')) {
    function getCurrentAdminName()
    {
        return getCurrentAdminEntity()->adminUserName;
    }
}

if (!function_exists('getCurrentAdminEntity')) {
    function getCurrentAdminEntity()
    {
        return adminGuard()->user();
    }
}

if (!function_exists('backendIsLogin')) {
    function backendIsLogin()
    {
        return adminGuard()->check();
    }
}
