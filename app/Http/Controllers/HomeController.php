<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        return isBackendArea() ? view('backend/index') : view('frontend/index');
    }
}
