<?php

namespace App\Services;
use App\Models\UserModel;
class UserService extends BaseService
{
    private $user;
    function __construct()
    {
        parent::__construct();
        $this->user=new UserModel();
    }


    function getAllUser()
    {
        return $this->user->findAll();
    }
    
}