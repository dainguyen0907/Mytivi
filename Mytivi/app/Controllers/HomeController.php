<?php

namespace App\Controllers;
use App\Services\ProgramService;
use App\Services\UserService;

class HomeController extends BaseController
{
    private $userService;
    private $programService;

    public function __construct()
    {
        $this->userService=new UserService;
        $this->programService=new ProgramService;
    }
    public function index()
    {
        $data=[];
        $cssLib=[];
        $jsLib=[];
        $dataLayout['countUser']=$this->userService->countUser();
        $dataLayout['countProgram']=$this->programService->countProgram();
        $data=$this->loadMasterLayout($data,'Trang chủ','pages/index',$dataLayout,$cssLib,$jsLib);
        return view('main',$data);
    }
    public function login()
    {
        return view('login');
    }

    public function changePassword()
    {
        if(session('userSession'))
        {
            return $this->userService->updateUserPasswordWithAuth(session('userSession')['user_id'],$this->request);
        }
        return 'SessionMissing';
    }
}
