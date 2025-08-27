<?php

namespace app\api;

use app\model\ListTasksModel;
use core\SessionManager;

class HelpdeskController
{
    private ListTasksModel $listTasksModel;
    public function __construct(ListTasksModel $listTasksModel)
    {
        $this->listTasksModel = $listTasksModel;
    }
    public function listHelpdesk()
    {
        $helpdesk = $this->listTasksModel->listTasks(SessionManager::getInstance()->getUserSession()['username']);
        return $helpdesk;
    }
}
