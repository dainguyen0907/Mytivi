<?php

namespace App\Controllers;

use App\Common\ResultUtils;
use App\Services\UserService;

class LoginController extends BaseController
{
    protected $service;

    function __construct()
    {
        $this->service = new UserService();

    }
    public function index()
    {
        if (session('userSession')) {
            return redirect("admin");
        }
        return view('login');
    }

    public function login()
    {
        $result = $this->service->checkLogin($this->request);
        if ($result['status'] === ResultUtils::STATUS_CODE_OK) {
            return redirect("admin");
        }
        return redirect()->back()->withInput()->with($result['messageCode'], $result['messages']);
    }

    public function logout()
    {
        if (session('userSession')) {
            session()->destroy();
        }
        return redirect("login");
    }

}