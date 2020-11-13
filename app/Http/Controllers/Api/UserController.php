<?php

namespace App\Http\Controllers\Api;

use App\Models\Entities\User;
use App\Repositories\UserRepository;
use App\Validators\User as UserValidator;

class UserController extends ApiBaseController
{
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function index()
    {
        $pagination = json_decode(request('pagination'));
        $limit = property_exists($pagination, 'perPage') ? $pagination->perPage : getConfig('pagination.perPage');
        $users = User::where('del_flag', getConfig('del_flag.on'))->orWhereNull('del_flag')->orderBy('id', 'desc')->paginate($limit);
        return response($users);
    }

    public function destroy($id)
    {
        try {
            $update = User::where('id', $id)
                ->update(['del_flag' => getConfig('del_flag.off')]);
            if ($update) {
                $this->ajaxSetMessage(transMessage('delete_success'));
                return $this->renderJson();
            }
        } catch (\Exception $e) {
            // @todo logError($e)
        }

        $this->ajaxSetMessage(transMessage('system_error'));
        return $this->renderErrorJson();
    }

    public function store()
    {
        $params = [
            'userName' => '',
            'userPhone' => '',
            'userGender' => '',
            'userAddress' => '',
        ];

        /** @var UserValidator $validator */
        $validator = $this->getRepository()->getValidator();

        if (!$validator->backendValidateStoreUser($params)) {
            $this->ajaxSetMessage($validator->errors());
            return $this->renderErrorJson(505);
        }

        try {
            $entity = new User();
            $entity->fill($params);
            $entity->save();

            $this->ajaxSetMessage(transMessage('add_success'));
            return $this->renderJson();
        } catch (\Exception $e) {
            $this->ajaxSetMessage(transMessage('system_error'));
        }


        return $this->renderErrorJson();
    }
}
