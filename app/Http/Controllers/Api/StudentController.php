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
            $viewData['notification'] = "Deleted successfully";
        } catch (\Exception $e) {
            $viewData['notification'] = "System Error";
        }

        $viewData['students'] = Student::where('del_flag', getConfig('del_flag.on'))->get();
        return response()->json($viewData);
    }

    public function store()
    {
        $entity = new Student();
        $params = [
            'full_name' => request('full_name'),
            'address' => request('address'),
            'phone_number' => request('phone_number')
        ];
        $entity->fill($params);
        $entity->save();

        return $this->renderJson();
    }
}
