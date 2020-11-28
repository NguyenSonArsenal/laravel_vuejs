<?php

namespace App\Http\Controllers;

use App\Http\Supports\ApiResponse;
use App\Http\Supports\RepositoryUtil;

class BaseController extends Controller
{
    // use: trait
    use ApiResponse;
    use RepositoryUtil;
}
