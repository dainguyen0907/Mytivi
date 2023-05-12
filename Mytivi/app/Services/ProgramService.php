<?php

namespace App\Services;
use App\Common\ResultUtils;
use App\Models\ProgramModel;
use Exception;
class ProgramService extends BaseService
{
    private $program;
    function __construct()
    {
        parent::__construct();
        $this->program=new ProgramModel();
        $this->program->protect(false);
    }


    function getAllProgram()
    {
        return $this->program->join('catalogue','programs.id_catalogue=catalogue.id_catalogue')->findAll();
    }

    function createProgram($rqData)
    {
        $validate = $this->validateProgramInfo($rqData);

        if($validate->getErrors())
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validate->getErrors()
            ];
        }
        try
        {
            $info=$rqData->getPost();
            $files=$rqData->getFile('video');
            $newFileName=$files->getRandomName();
            $Param=[
                'name_program'=>$info['name_program'],
                'id_catalogue'=>$info['id_catalogue'],
            ];
            if (! $files->hasMoved()) {
                $files->move('uploads/',$newFileName);
    
                $Param['link_program']= base_url().'uploads/'.$newFileName;
            }
            $this->program->save($Param);

            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'messages' => ['success'=>'Thêm chương trình mới thành công']
            ];
        }
        catch(Exception $e)
        {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['error'=>$e->getMessage()]
            ];
        }
    }

    function validateProgramInfo($rqData)
    {
        $rule = [
            'name_program' => 'max_length[290]|is_unique[programs.name_program]',
            'id_catalogue' => 'required',
            'video'=>'max_size[video,204800]|mime_in[video,video/mp4,video/mpeg]'
        ];

        $message = [
            'name_program' => [
                'max_length' => 'Độ dài tên chương trình không quá 100 ký tự',
                'is_unique' => 'Chương trình đã tồn tại',
            ],
            'id_catalogue' => [
                'required' => 'Hãy chọn thể loại',
            ],
            'video' => [
                'max_size' => 'File quá lớn',
                'mime_in'=>"Định dạng không phù hợp"
            ],
        ];

        $this->validation->setRules($rule, $message);
        $this->validation->withRequest($rqData)->run();

        return $this->validation;
    }
    
}