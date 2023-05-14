<?php

namespace App\Services;

use App\Common\ResultUtils;
use App\Models\ProgramModel;
use App\Models\ScheduleModel;
use Exception;

class ProgramService extends BaseService
{
    private $program;
    private $schedule;
    function __construct()
    {
        parent::__construct();
        $this->program = new ProgramModel();
        $this->schedule = new ScheduleModel();

        $this->program->protect(false);
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
            $Param = [
                'name_program' => $info['name_program'],
                'id_catalogue' => $info['id_catalogue'],
            ];
            if (!$files->hasMoved()) {
                $files->move('uploads/', $newFileName);

                $Param['link_program'] = base_url() . 'uploads/' . $newFileName;
            }
            $this->program->save($Param);

            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'messages' => ['success' => 'Thêm chương trình mới thành công']
            ];
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
            'video' => 'max_size[video,204800]|mime_in[video,video/mp4,video/mpeg]'
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
                'mime_in' => "Định dạng không phù hợp"
            ],
        ];

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