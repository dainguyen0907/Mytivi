<?php

namespace App\Controllers;

class ContactController extends BaseController
{
    public function index()
    {
        $data=[];
        $cssLib=[];
        $jsLib=[];
        $data=$this->loadMasterLayout($data,'Liên hệ','pages/contact',$cssLib,$jsLib);
        return view('main',$data);
    }
}
