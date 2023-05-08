<?php

namespace App\Services;
use App\Models\ProgramModel;
class ProgramService extends BaseService
{
    private $program;
    function __construct()
    {
        parent::__construct();
        $this->program=new ProgramModel();
    }


    function getAllProgram()
    {
        return $this->program->findAll();
    }
    
}