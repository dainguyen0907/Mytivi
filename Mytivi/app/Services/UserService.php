<?php

namespace App\Services;
use App\Models\UserModel;
use App\Common\ResultUtils;
use Exception;
class UserService extends BaseService
{
    private $user;
    function __construct()
    {
        parent::__construct();
        $this->user=new UserModel();
        $this->user->protect(false);
    }


    function getAllUser()
    {
        return $this->user->findAll();
    }

    function addUserInfo($rqData)
    {
        $validate= $this->validateUser($rqData);

        if($validate->getErrors()){
            return [
                'status'=>ResultUtils::STATUS_CODE_ERR,
                'messageCode'=>ResultUtils::MESSAGE_CODE_ERR,
                'messages'=>$validate->getErrors()
            ];
        }
        try{
            $dataSave=$rqData->getPost();
            $fillData['user_name']=$dataSave['account'];
            $fillData['user_email']=$dataSave['email'];
            $fillData['user_password']=password_hash($dataSave['password'],PASSWORD_BCRYPT);
            $this->user->save($fillData);
            return [
            'status'=>ResultUtils::STATUS_CODE_OK,
            'messageCode'=>ResultUtils::MESSAGE_CODE_OK,
            'messages'=>['success'=>'Thêm dữ liệu thành công']
        ];
        }catch(Exception $e)
        {
            return [
                'status'=>ResultUtils::STATUS_CODE_ERR,
                'messageCode'=>ResultUtils::MESSAGE_CODE_ERR,
                'messages'=>$e->getMessage()
            ];
        }
        
        
    }

    function validateUser($rqData)
    {
        $rule=[
            'email'=>'valid_email|max_length[200]|is_unique[user.user_email]',
            'account'=>'max_length[100]|is_unique[user.user_name]',
            'password'=>'max_length[30]|min_length[6]',
            'password_confirm'=>'matches[password]'
        ];

        $message=[
            'email'=>[
                'valid_email'=>'Email không đúng định dạng',
                'max_length'=> 'Email không quá 200 ký tự',
                'is_unique'=>'Email đã được đăng ký',
            ],
            'account'=>[
                'max_length'=> 'Độ dài tài khoản không quá 100 ký tự',
                'is_unique'=>'Tài khoản đã tồn tại',
            ],
            'password'=>[
                'max_length'=> 'Mật khẩu không quá 20 ký tự',
                'min_length'=> 'Mật khẩu phải từ 6 ký tự trở lên',
            ],
            'password_confirm'=>[
                'matches'=>'Mật khẩu nhập lại chưa đúng',
            ],
        ];

        $this->validation->setRules($rule,$message);
        $this->validation->withRequest($rqData)->run();

        return $this->validation;
    }
    
}