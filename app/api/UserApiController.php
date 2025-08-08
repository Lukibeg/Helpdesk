<?php

namespace app\api;
use app\model\ListUsersModel;
use function app\helpers\viewJson;

class UserApiController
{
    public function list()
    {
        $listUsersModel = new ListUsersModel();
        $users = $listUsersModel->listUsersJson();

        if ($users['success'] === false) {
            http_response_code(500);
            viewJson(['error' => $users['error']], false);
            return;
        }

        viewJson($users['data'], true);
    }
    public function show()
    {
        echo 'show';
    }
}
