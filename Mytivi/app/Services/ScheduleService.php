<?php

namespace App\Services;

use App\Common\ResultUtils;
use App\Models\ScheduleModel;
use Exception;

class ScheduleService extends BaseService
{
    private $schedule;
    function __construct()
    {
        parent::__construct();
        $this->schedule = new ScheduleModel();

        $this->schedule->protect(false);
    }


    function getAllSchedule()
    {
        return $this->schedule->join('programs', 'schedule.id_program=programs.id_program')->findAll();
    }

    function createSchedule($rqData)
    {
        $validation = $this->valadateScheduleInfo($rqData);

        if ($validation->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validation->getErrors
            ];
        }

        $data = $rqData->getPost();
        if ($this->checkScheduleTime($data['time_start'],$data['priority'])['status'] === ResultUtils::STATUS_CODE_OK) {
            try {
                $this->schedule->save($data);
                return [
                    'status' => ResultUtils::STATUS_CODE_OK,
                    'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                    'messages' => ['success' => 'Tạo mới thành công']
                ];
            } catch (Exception $e) {
                return [
                    'status' => ResultUtils::STATUS_CODE_ERR,
                    'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                    'messages' => ['errors' => $e->getMessage()]
                ];
            }

        } else {
            return $this->checkScheduleTime($data['time_start'],$data['priority']);
        }

    }

    function updateSchedule($rqData)
    {
        $validation = $this->valadateScheduleInfo($rqData);

        if ($validation->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validation->getErrors
            ];
        }

        $data = $rqData->getPost();
        if ($this->checkScheduleTime($data['time_start'],$data['priority'])['status'] === ResultUtils::STATUS_CODE_OK) {
            try {
                $param=[
                    'id_schedule'=>$data['id_schedule'],
                    'id_program'=>$data['id_program'],
                    'time_start'=>$data['time_start'],
                    'time_end'=>$data['time_end'],
                    'priority'=>$data['priority']
                ];
                $this->schedule->save($param);
                return [
                    'status' => ResultUtils::STATUS_CODE_OK,
                    'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                    'messages' => ['success' => 'Cập nhật thành công']
                ];
            } catch (Exception $e) {
                return [
                    'status' => ResultUtils::STATUS_CODE_ERR,
                    'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                    'messages' => ['errors' => $e->getMessage()]
                ];
            }

        } else {
            return $this->checkScheduleTime($data['time_start'],$data['priority']);
        }

    }
    function valadateScheduleInfo($rqData)
    {
        $rule = [
            'id_program' => 'required',
            'priority' => 'required',
            'time_start' => 'required',
            'time_end' => 'required'
        ];

        $message = [
            'id_program' => [
                'required' => 'Hãy chọn chương trình'
            ],
            'priority' => [
                'required' => 'Hãy chọn độ ưu tiên'
            ],
            'time_start' => [
                'required' => 'Chưa nhập giờ bắt đầu'
            ],
            'time_end' => [
                'required' => 'Chưa nhập giờ kết thúc'
            ]
        ];

        $this->validation->setRules($rule, $message);
        $this->validation->withRequest($rqData)->run();
        return $this->validation;
    }
    function checkScheduleTime($time_start,$priority)
    {
        if ($this->schedule->where(['time_start <' => $time_start, 'time_end >' => $time_start, 'priority' => $priority])->first()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['timeValid' => 'Thời gian chiếu bị trùng với chương trình ưu tiên!']
            ];
        }
        return [
            'status' => ResultUtils::STATUS_CODE_OK,
            'messageCode' => ResultUtils::MESSAGE_CODE_OK,
            'messages' => ['timeValid' => 'Thời gian chiếu hợp lệ!']
        ];
    }

    function deleteSchedule($rqData)
    {
        try {
            $data = $rqData->getPost();
            $this->schedule->where('id_schedule', $data['id'])->delete();
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'messages' => ['success' => 'Xóa lịch chiếu thành công']
            ];
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['errors' => $e->getMessage()]
            ];
        }



    }

    function getScheduleApi($rqData)
    {
        $data=$rqData->getPost();
        return $this->schedule->join('programs','schedule.id_program=programs.id_program')->where('priority',$data['priority'])->orderBy('time_start','ASC')->findAll();
    }

}