<?php

namespace App\Controllers;

class ContactController extends BaseController
{
    public function index()
    {
        $data=[];
        $cssLib=[];
        $jsLib=[];
        $dataLayout=[];
        $data=$this->loadMasterLayout($data,'Liên hệ','pages/contact',$dataLayout,$cssLib,$jsLib);
        return view('main',$data);
    }
}
