<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;

class LoginController extends ApiBaseController
{
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function postLogin()
    {
        dd(request()->all());
    }
}
