<?php

namespace App\Controllers;

use App\Common\ResultUtils;
use App\Services\CatalogueService;
use App\Services\ProgramService;

class ProgramController extends BaseController
{
    private $programs;
    private $catalogueService;

    function __construct()
    {
        $this->programs=new ProgramService();
        $this->catalogueService=new CatalogueService();
    }
    public function index()
    {
        $data=[];
        $cssLib = ["https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css",];
        $jsLib = ["http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js", base_url() . "/assets/js/dataTable.js"];
        $dataLayout["programs"]=$this->programs->getAllProgram();
        $dataLayout["catalogues"]=$this->catalogueService->getAllCatalogue();
        $data=$this->loadMasterLayout($data,'Chương trình','pages/program-list',$dataLayout,$cssLib,$jsLib);
        return view('main',$data);
    }

     //Show page add program
    public function addPage()
    {
        $data = [];
        $cssLib = [];
        $jsLib = [];
        $dataLayout["catalogues"]=$this->catalogueService->getAllCatalogue();
        $data = $this->loadMasterLayout($data, 'Thêm chương trình mới', 'pages/program-add',$dataLayout, $cssLib, $jsLib);
        return view('main', $data);
    }

    public function create()
    {
        $result=$this->programs->createProgram($this->request);
        if($result['status']===ResultUtils::STATUS_CODE_OK)
        {
            return redirect("admin/program")->withInput()->with($result['messageCode'],$result['messages']);
        }
        return redirect()->back()->withInput()->with($result['messageCode'],$result['messages']);
    }

    public function delete()
    {
        $result=$this->programs->deleteProgram($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['messages']);
    }
    public function update()
    {
        $result=$this->programs->updateProgram($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['messages']);
    }


}