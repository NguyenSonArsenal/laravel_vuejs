<?php

namespace App\Http\Controllers\Api;

use App\Models\Entities\User;
use App\Repositories\UserRepository;

class LoginController extends ApiBaseController
{
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function postLogin()
    {
        $user = User::where('userEmail', request('userEmail'))
            ->where('userStatus', getConfig('user.userStatus.active'))
            ->where('del_flag', '=', getConfig('del_flag.on'))
            ->first();

        // @todo check password

        // if login success
        if (false) {
            $this->ajaxSetMessage(transMessage('success'));
            return $this->renderJson();
        }

        $this->ajaxSetErrorValidate(transMessage('login_error'));
        return $this->renderErrorJson();

        // else login error

//        if (!empty($user) && Hash::check(request('userPassword'), $user->userPassword)) {
//            adminGuard()->login($user);
//            return redirect()->route(backendBuildRouteName('dashboard'));
//        }

//        return $this->_backWithError(['errors' => transMessage('login_error')]);
    }
}
