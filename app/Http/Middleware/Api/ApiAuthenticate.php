<?php

namespace App\Http\Middleware\Api;

use Closure;

class ApiAuthenticate
{
    public function handle($request, Closure $next)
    {
        $a = 1;
        return $next($request);

        // Ignore request to login page
        if ($request->is('*login')) {
            return $next($request);
        }

        // If the user is not logged in, go to the login page
        if ($this->_check()) {
            // return redirect()->route(backendBuildRouteName('get.login'));
        }

        return $next($request);
    }

    protected function _check()
    {
        //not logged in or deleted or status disable
        return !getCurrentAdminEntity() ||
            getCurrentAdminEntity()->{getSystemConfig('deleted_at_column')} ||
            getCurrentAdminEntity()->isAdminStatusDisabled();
    }
}
