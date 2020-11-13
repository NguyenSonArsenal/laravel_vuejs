<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    // ajax
    protected $_ajaxCode = 200;
    protected $_ajaxMessage = [];
    protected $_ajaxData = [];
    protected $_ok = true;

    protected $_repository = null;

    public function setRepository($repository)
    {
        $this->_repository = $repository;
    }

    public function getRepository()
    {
        return $this->_repository;
    }

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

    public function ajaxSetErrorValidate($msg = [])
    {
        if (!is_array($msg)) {
        $msg = (array)$msg;
    }
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

    public function renderJson()
    {
        $response = [
            'ok' => true,
            'code' => $this->ajaxGetCode(),
            'message' => $this->ajaxGetMessage(),
            'data' => $this->ajaxGetData()
        ];

        return response()->json($response);
    }

    public function renderErrorJson($code = 500)
    {
        $this->ajaxSetCode($code);
        return $this->renderJson();
    }
}
