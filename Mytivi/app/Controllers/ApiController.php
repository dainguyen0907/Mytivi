<?php

namespace App\Controllers;

use App\Services\ScheduleService;
use CodeIgniter\API\ResponseTrait;
class ApiController extends BaseController
{
    use ResponseTrait;
    private $schedule;

    function __construct()
    {
        $this->schedule=new ScheduleService();
    }

    function index()
    {
        return $this->respond($this->schedule->getScheduleApi());
    }


}