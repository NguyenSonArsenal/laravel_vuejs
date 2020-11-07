<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

class UserController extends ApiBaseController
{
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
        try {
            $entity = new User();
            $params = [
                'full_name' => request('full_name'),
                'address' => request('address'),
                'phone_number' => request('phone_number'),
                'gender' => request('gender'),
                'date_of_birth' => request('date_of_birth'),
            ];
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
