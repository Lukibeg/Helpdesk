<?php

namespace app\controllers;

use app\model\ListUsersModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response;
use function app\helpers\view;

class ListUserController
{
    private ListUsersModel $listUsersModel;
    public function __construct(ListUsersModel $listUsersModel)
    {
        $this->listUsersModel = $listUsersModel;
    }
    public function listUsers(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $users = $this->listUsersModel->listUsersJson();
            return new Response(200, [], view('admin/users', ['title' => 'Usuários', 'data' => $users]));
        } catch (\PDOException $e) {
            return new Response(500, [], view('admin/users', ['title' => 'Usuários', 'data' => ['error' => $e->getMessage()]]));
        }
    }
}
