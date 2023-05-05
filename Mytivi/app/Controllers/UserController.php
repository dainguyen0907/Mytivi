<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function index()
    {
        $data=[];
        $cssLib=["https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css",];
        $jsLib=["http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js",];
        $data=$this->loadMasterLayout($data,'Tài khoản','pages/user-list',$cssLib,$jsLib);
        return view('main',$data);
    }
}
