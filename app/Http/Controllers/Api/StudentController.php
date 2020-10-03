<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;

class StudentController extends ApiBaseController
{
    public function index()
    {
        $students = Student::where('del_flag', getConfig('del_flag.on'))->orWhereNull('del_flag')->orderBy('id', 'desc')->get();
        return $students;
    }

    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            if ($student) {
                $student->del_flag = getConfig('del_flag.off');
                $student->save();
            }
            $this->ajaxSetMessage(transMessage('delete_success'));
            return $this->renderJson();
        } catch (\Exception $e) {
            $this->ajaxSetMessage(transMessage('system_error'));
        }

        return $this->renderErrorJson();
    }

    public function store()
    {
        try {
            $entity = new Student();
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
