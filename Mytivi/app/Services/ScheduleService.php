<?php

namespace App\Services;
use App\Models\ScheduleModel;
class ScheduleService extends BaseService
{
    private $schedule;
    function __construct()
    {
        parent::__construct();
        $this->schedule=new ScheduleModel();
    }


    function getAllSchedule()
    {
        return $this->schedule->join('programs','schedule.id_program=programs.id_program')->findAll();
    }
    
}