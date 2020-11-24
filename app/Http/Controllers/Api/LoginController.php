<?php

namespace App\Http\Controllers\Api;

use App\Models\Entities\Districts;
use App\Models\Entities\Provinces;
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
        // if (!empty($user) && Hash::check(request('userPassword'), $user->userPassword)) {
        if (true) {
            $data = $this->_getDataAfterLogin();
//            adminGuard()->login($user);
            $this->ajaxSetData($data);
            $this->ajaxSetMessage(transMessage('success'));
            return $this->renderJson();
        }

        $this->ajaxSetErrorValidate(transMessage('login_error'));
        return $this->renderErrorJson();
    }

    protected function _getDataAfterLogin()
    {
        $provinces = Provinces::select('id', 'name')->get()->toArray();
        $districts = Districts::select('id', 'name', 'province_id')->get()->toArray();
        $genders = getConfig('database.gender');

        $data = [
            'gender' => $genders,
            'provinces' => $provinces,
            'districts' => $districts,
        ];

        return $data;
    }

    public function logout()
    {
        $a = 1;
//        adminGuard()->logout();
        return $this->renderJson();
    }
}
