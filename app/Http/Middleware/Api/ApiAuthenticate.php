<?php

namespace App\Http\Middleware\Api;

use App\Repositories\AdminRepository;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class ApiAuthenticate
{
    protected $_repository = null;

    /**
     * @return null
     */
    public function getRepository()
    {
        return $this->_repository;
    }

    /**
     * @param null $repository
     */
    public function setRepository($repository)
    {
        $this->_repository = $repository;
    }

    public function __construct(AdminRepository $adminRepository)
    {
        $this->setRepository($adminRepository);
    }

    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth($request)) {
            return $next($request);
        }
        throw new AuthenticationException(trans('messages.permission_denied'));
    }

    public function auth(Request $request)
    {
        $accessToken = $request->get('accessToken');
        if (!$accessToken) {
            return false;
        }
        $user = $this->getRepository()->where('accessToken', $accessToken)->first();
        if(empty($user)){
            return false;
        }
        apiGuard()->setUser($user);
        return true;
    }
}
