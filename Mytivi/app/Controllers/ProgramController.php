<?php

namespace App\Controllers;

class ProgramController extends BaseController
{
    public function index()
    {
        $data=[];
        $cssLib = ["https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css",];
        $jsLib = ["http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js", base_url() . "/assets/js/dataTable.js"];
        $data=$this->loadMasterLayout($data,'Chương trình','pages/program-list',$cssLib,$jsLib);
        return view('main',$data);
    }

     //Show page add program
    public function addPage()
    {
        $data = [];
        $cssLib = [];
        $jsLib = [];
        $data = $this->loadMasterLayout($data, 'Thêm chương trình mới', 'pages/program-add', $cssLib, $jsLib);
        return view('main', $data);
    }
}