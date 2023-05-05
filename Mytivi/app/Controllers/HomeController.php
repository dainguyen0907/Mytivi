<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $data=[];
        $cssLib=[];
        $jsLib=[];
        $data=$this->loadMasterLayout($data,'Trang chủ','pages/index',$cssLib,$jsLib);
        return view('main',$data);
    }
}
