<?php

namespace App\Services;

use App\Common\ResultUtils;
use App\Models\ProgramModel;
use App\Models\ScheduleModel;
use App\Services\ScheduleService;
use Exception;

class ProgramService extends BaseService
{
    private $program;
    private $schedule;
    private $scheduleService;
    function __construct()
    {
        parent::__construct();
        $this->program = new ProgramModel();
        $this->schedule = new ScheduleModel();
        $this->scheduleService=new ScheduleService();

        $this->program->protect(false);
        $this->schedule->protect(false);
    }


    function getAllProgram()
    {
        return $this->program->join('catalogue', 'programs.id_catalogue=catalogue.id_catalogue')->findAll();
    }

    function createProgram($rqData)
    {
        $validate = $this->validateProgramInfo($rqData);

        if ($validate->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validate->getErrors()
            ];
        }
        try {
            $info = $rqData->getPost();
            $files = $rqData->getFile('video');
            $newFileName = $files->getRandomName();
            if($this->scheduleService->checkScheduleTime($info['time_start'],$info['priority'])['status']===ResultUtils::STATUS_CODE_OK)
            {
                $Param = [
                    'name_program' => $info['name_program'],
                    'id_catalogue' => $info['id_catalogue'],
                ];
                if (!$files->hasMoved()) {
                    $files->move('uploads/', $newFileName);
    
                    $Param['link_program'] = base_url() . 'uploads/' . $newFileName;
                }
                $this->program->save($Param);
    
                $Param_schedule=[
                    'time_start'=>$info['time_start'],
                    'time_end'=>$info['time_end'],
                    'priority'=>$info['priority'],
                    'id_program'=>$this->program->orderBy('id_program','DESC')->first()['id_program']
                ];
                $this->schedule->save($Param_schedule);
                return [
                    'status' => ResultUtils::STATUS_CODE_OK,
                    'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                    'messages' => ['success' => 'Thêm chương trình mới thành công']
                ];
            }
            else
            {
                return $this->scheduleService->checkScheduleTime($info['time_start'],$info['priority']);
            }
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['error' => $e->getMessage()]
            ];
        }
    }
    function validateProgramInfo($rqData)
    {
        $rule = [
            'name_program' => 'max_length[290]|is_unique[programs.name_program]',
            'id_catalogue' => 'required',
            'time_start'=>'required',
            'time_end'=>'required',
            'video' => 'max_size[video,204800]|mime_in[video,video/mp4,video/mpeg]'
        ];

        $message = [
            'name_program' => [
                'max_length' => 'Độ dài tên chương trình không quá 290 ký tự',
                'is_unique' => 'Chương trình đã tồn tại',
            ],
            'id_catalogue' => [
                'required' => 'Chưa chọn thể loại',
            ],
            'time_start'=>['required' => 'Chưa nhập thời gian bắt đầu',],
            'time_end'=>[
                'required' => 'Chưa nhập thời gian kết thúc'
            ],
            'video' => [
                'max_size' => 'File quá lớn',
                'mime_in' => "Định dạng không phù hợp"
            ],
        ];

        $this->validation->setRules($rule, $message);
        $this->validation->withRequest($rqData)->run();

        return $this->validation;
    }
    function updateProgram($rqData)
    {
        $validate = $this->validateProgramUpdate($rqData);

        if ($validate->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validate->getErrors()
            ];
        }
        try {
            $info = $rqData->getPost();
            $files = $rqData->getFile('video');
            $Param = [
                'id_program' => $info['id_program'],
                'name_program' => $info['name_program'],
                'id_catalogue' => $info['id_catalogue']
            ];
            if (is_file($files)) {
                if ($this->deleteFile($info['id_program'])) {
                    $newFileName = $files->getRandomName();
                    if (!$files->hasMoved()) {
                        $files->move('uploads/', $newFileName);
                        $Param['link_program'] = base_url() . 'uploads/' . $newFileName;
                    }
                }

            }
            

            $this->program->save($Param);

            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'messages' => ['success' => 'Cập nhật chương trình thành công']
            ];
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['error' => $e->getMessage()]
            ];
        }
    }
    function validateProgramUpdate($rqData)
    {
        $rule = [
            'name_program' => 'max_length[290]',
            'id_catalogue' => 'required'
        ];
        

        $message = [
            'name_program' => [
                'max_length' => 'Độ dài tên chương trình không quá 290 ký tự',
            ],
            'id_catalogue' => [
                'required' => 'Hãy chọn thể loại',
            ]
        ];
        $video=$rqData->getFile('video');
        if(is_file($video))
        {
            $rule['video']='max_size[video,204800]|mime_in[video,video/mp4,video/mpeg]';
            $message['video']=['max_size' => 'File quá lớn','mime_in' => "Định dạng không phù hợp"];
        }

        $this->validation->setRules($rule, $message);
        $this->validation->withRequest($rqData)->run();

        return $this->validation;
    }

    function deleteProgram($rqData)
    {
        $id = $rqData->getPost()['id'];
        if (!$this->deleteFile($id)) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['errorFile' => 'Không thể xóa file']
            ];
        }
        try {
            $this->schedule->where('id_program', $id)->delete();
            $this->program->where('id_program', $id)->delete();
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'messages' => ['success' => 'Xóa thành công']
            ];
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['error' => $e->getMessage()]
            ];
        }
    }
    function deleteFile($id)
    {
        try {
            $data = $this->program->where('id_program', $id)->first();
            $url = substr($data['link_program'], strlen(base_url()));
            if (file_exists($url)) {
                unlink($url);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


}