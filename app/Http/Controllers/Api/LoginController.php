<?php

namespace App\Http\Controllers\Api;

use App\Models\Entities\Admin;
use App\Models\Entities\Districts;
use App\Models\Entities\Provinces;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Hash;
use App\Validators\Admin as AdminValidator;

class LoginController extends ApiBaseController
{
    public function __construct(AdminRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function postLogin()
    {
        $params = request()->all();

        $validator = $this->getRepository()->getValidator();
        /** @var AdminValidator $validator */
        if (!$validator->apiValidatePostLogin($params)) {
            return $this->renderErrorJson($params, $validator->errors());
        }

        $adminEmail = arrayGet($params, 'adminEmail');
        $adminPassword = arrayGet($params, 'adminPassword');

        $admin = Admin::where('adminEmail', $adminEmail)
            ->where('adminStatus', getConfig('common.status.active.id'))
            ->where('del_flag', '=', getConfig('del_flag.on'))
            ->first();

        if (!empty($admin) && Hash::check($adminPassword, $admin->adminPassword)) {
            $admin->renewAccessToken();
            $data = $this->_getDataAfterLogin();
            $data = array('token' => $admin->{$admin->accessTokenFieldName()}) + $data;
            apiGuard()->login($admin);
            return $this->renderJson($data, transMessage('success'));
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
        apiGetCurrentUser()->resetAccessToken();
        apiGuard()->logout(); // log the user out of our application
        return $this->renderJson();
    }
}
