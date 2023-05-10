<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $data=[];
        $cssLib=[];
        $jsLib=[];
        $dataLayout=[];
        $data=$this->loadMasterLayout($data,'Trang chủ','pages/index',$dataLayout,$cssLib,$jsLib);
        return view('main',$data);
    }
    public function login()
    {
        return view('login');
    }
}
