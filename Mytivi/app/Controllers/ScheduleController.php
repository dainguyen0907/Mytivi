<?php

namespace App\Controllers;
use App\Common\ResultUtils;
use App\Services\ProgramService;
use App\Services\ScheduleService;
class ScheduleController extends BaseController
{
    private $schedules;
    private $programs;

    function __construct(){
        $this->schedules=new ScheduleService();
        $this->programs=new ProgramService();
    }
    public function index()
    {
        $data=[];
        $cssLib = ["https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css",];
        $jsLib = ["http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js", base_url() . "assets/js/dataTable.js"];
        $dataLayout["schedules"]=$this->schedules->getAllSchedule();
        $dataLayout["programs"]=$this->programs->getAllProgram();
        $data=$this->loadMasterLayout($data,'Lịch chiếu','pages/schedule-list',$dataLayout,$cssLib,$jsLib);
        return view('main',$data);
    }

     //Show page add schedule
    public function addPage()
    {
        $data = [];
        $cssLib = [];
        $jsLib = [];
        $dataLayout["programs"]=$this->programs->getAllProgram();
        $data = $this->loadMasterLayout($data, 'Thêm lịch chiếu mới', 'pages/schedule-add',$dataLayout, $cssLib, $jsLib);
        return view('main', $data);
    }

    public function create()
    {
        $result=$this->schedules->createSchedule($this->request);
        if($result['status']===ResultUtils::STATUS_CODE_OK)
        {
            return redirect()->to('admin/schedule')->withInput()->with($result['messageCode'],$result['messages']);
        }
        return redirect()->back()->withInput()->with($result['messageCode'],$result['messages']);
    }

    public function update()
    {
        $result=$this->schedules->updateSchedule($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['messages']);
    }

    public function delete()
    {
        $result=$this->schedules->deleteSchedule($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'],$result['messages']);
    }
}