<?php

namespace App\Http\Controllers;

use App\Service\UserListService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $service;

    public function __construct(UserListService $service)
    {
        $this->service = $service;
    }
}
