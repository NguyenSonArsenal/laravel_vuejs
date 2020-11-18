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
        $limit = property_exists($pagination, 'perPage') ? $pagination->perPage : getBackendConfig('pagination.perPage');
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
        $params = request()->all();
        $params['userGender'] = $params['userGender']['id'];

        /** @var UserValidator $validator */
        $validator = $this->getRepository()->getValidator();

        if (!$validator->backendValidateStoreUser($params)) {
            $this->ajaxSetErrorValidate($validator->errors());
            return $this->renderErrorJson();
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

    public function edit($id)
    {
        $entity = $this->getRepository()->findById($id);
        if (empty($entity)) {
            // @todo return redirect to 404 page
        }
        $listGender = getConfig('database.gender');
        $entity->userGender = arrayGet($listGender, $entity->userGender);
        return response($entity);
    }

    public function update($id)
    {
        $params = request()->all();
        $params['userGender'] = $params['userGender']['id'];

        /** @var UserValidator $validator */
        $validator = $this->getRepository()->getValidator();

        if (!$validator->backendValidateUpdateUser($params)) {
            $this->ajaxSetErrorValidate($validator->errors());
            return $this->renderErrorJson();
        }

        try {
            $entity = $this->getRepository()->findById($id);

            if (empty($entity)) {
                $this->ajaxSetMessage(transMessage('system_error'));
                return $this->renderErrorJson();
            }

            $entity->fill($params);
            $entity->save();

            $this->ajaxSetMessage(transMessage('update_success'));
            return $this->renderJson();
        } catch (\Exception $e) {
            $this->ajaxSetMessage(transMessage('system_error'));
        }


        return $this->renderErrorJson();

    }
}
