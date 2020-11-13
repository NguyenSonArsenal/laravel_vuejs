<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Supports\RepositoryUtil;

class ApiBaseController extends BaseController
{
    // use: trait
    use RepositoryUtil;
}
