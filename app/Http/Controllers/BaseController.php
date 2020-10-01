<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    // ajax
    protected $_ajaxCode = 200;
    protected $_ajaxMessage = [];
    protected $_ajaxData = [];
    protected $_ok = true;

    public function ajaxGetCode()
    {
        return $this->_ajaxCode;
    }

    public function ajaxSetCode($code = 200)
    {
        return $this->_ajaxCode = $code;
    }

    public function ajaxGetData()
    {
        return $this->_ajaxData;
    }

    public function ajaxSetData($data)
    {
        return $this->_ajaxData = $data;
    }

    public function ajaxGetMessage()
    {
        return $this->_ajaxMessage;
    }

    public function ajaxSetMessage($msg = '')
    {
        return $this->_ajaxMessage = $msg;
    }

    public function ajaxGetOk()
    {
        return $this->_ok;
    }

    public function ajaxSetOk($ok = true)
    {
        return $this->_ok = $ok;
    }

    public function renderJson($message = [], $data = [])
    {
        $response = [
            'ok' => true,
            'code' => $this->ajaxGetCode(),
            'message' => is_null($message) ? ['Thành công'] : $message,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function renderErrorJson($message = [], $data = [], $code = 500)
    {
        $response = [
            'ok' => false,
            'code' => $code,
            'message' => is_null($message) ? ['Lỗi hệ thống'] : $message,
            'data' => $data
        ];

        return response()->json($response);
    }
}
