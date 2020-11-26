<?php

namespace App\Http\Controllers\Api;

use App\Models\Entities\Admin;
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
        $admin = Admin::where('adminEmail', 'admin@gmail.com')
            ->where('adminStatus', getConfig('common.status.active.id'))
            ->where('del_flag', '=', getConfig('del_flag.on'))
            ->first();

        // @todo check password
        // if (!empty($user) && Hash::check(request('userPassword'), $user->userPassword)) {
        if (true) {
            $data = $this->_getDataAfterLogin();
            adminGuard()->login($admin);
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
        adminGuard()->logout();
        return $this->renderJson();
    }
}
