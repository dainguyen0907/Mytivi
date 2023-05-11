<?php

namespace App\Controllers;

use App\Services\UserService;

class UserController extends BaseController
{

    private $service;

    function __construct()
    {
        $this->service = new UserService();
    }
    public function index()
    {
        $data = [];
        $cssLib = ["https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css",];
        $jsLib = ["http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js", base_url() . "/assets/js/dataTable.js"];
        $dataLayout["users"]= $this->service->getAllUser();
        $data = $this->loadMasterLayout($data, 'Tài khoản', 'pages/user-list',$dataLayout, $cssLib, $jsLib);
        return view('main', $data);
    }

    //Show page add user
    public function addPage()
    {
        $data = [];
        $cssLib = [];
        $jsLib = [];
        $dataLayout=[];
        $data = $this->loadMasterLayout($data, 'Thêm tài khoản', 'pages/user-add',$dataLayout, $cssLib, $jsLib);
        return view('main', $data);
    }

    public function create()
    {
        $result= $this->service->addUserInfo($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['messages']);
    }

    public function update()
    {
        $result= $this->service->updateUserPass($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['messages']);
    }

    public function delete()
    {
        $result= $this->service->deleteUser($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['messages']);
    }
}