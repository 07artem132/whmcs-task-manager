<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 21.04.2019
 * Time: 16:41
 */

namespace WHMCS\Module\Addon\TaskManager\API;

use WHMCS\Module\Addon\TaskManager\Traits\IsRequestMethodTraits;
use WHMCS\Scheduling\Task\AbstractTask;

class AdminAjaxApi
{
    use IsRequestMethodTraits;

    function boot()
    {
        if (!$this->isRequestMethod('POST')) {
            return;
        }

        switch (true) {
            case array_key_exists('task_id', $_POST) &&
                array_key_exists('enable', $_POST):

                $TaskModel = AbstractTask::find($_POST['task_id']);
                $TaskModel->is_enabled = (bool)(int)$_POST['enable'];
                $TaskModel->save();

                $this->response('success', 'Изменения сохранены');
                break;
            case array_key_exists('task_id', $_POST) &&
                array_key_exists('periodic', $_POST):

                $TaskModel = AbstractTask::find($_POST['task_id']);
                $TaskModel->is_periodic = (bool)(int)$_POST['periodic'];
                $TaskModel->save();

                $this->response('success', 'Изменения сохранены');
                break;
            case array_key_exists('task_id', $_POST) &&
                array_key_exists('delete', $_POST):

                AbstractTask::destroy($_POST['task_id']);

                $this->response('success', 'Изменения сохранены');
                break;
            case array_key_exists('task_id', $_POST) &&
                array_key_exists('name', $_POST) &&
                array_key_exists('class_name', $_POST) &&
                array_key_exists('priority', $_POST) &&
                array_key_exists('frequency', $_POST) &&
                array_key_exists('description', $_POST):

                $TaskModel = AbstractTask::find($_POST['task_id']);
                $TaskModel->name = $_POST['name'];
                $TaskModel->class_name = $_POST['class_name'];
                $TaskModel->priority = $_POST['priority'];
                $TaskModel->frequency = $_POST['frequency'];
                $TaskModel->description = $_POST['description'];
                $TaskModel->save();

                $this->response('success', 'Изменения сохранены');
                break;
            default:
                $this->response('error', 'Неизвестное действие');
                break;
        }
    }

    function response($status, $message = null)
    {
        echo json_encode([
            'status' => $status,
            'message' => $message
        ]);
        die();
    }
}