<?php

namespace App\Http\Controllers\Api;

class DashboardController extends ApiBaseController
{
    public function __construct()
    {

    }

    public function index()
    {
        return $this->renderJson();
    }
}
