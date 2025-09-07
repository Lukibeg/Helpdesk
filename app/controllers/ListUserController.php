<?php

namespace app\controllers;

use app\model\ListUsersModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response;
use League\Plates\Engine;

class ListUserController
{
    private ListUsersModel $listUsersModel;
    private Engine $engine;

    public function __construct(ListUsersModel $listUsersModel, Engine $engine)
    {
        $this->listUsersModel = $listUsersModel;
        $this->engine = $engine;
    }
    public function listUsers(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $users = $this->listUsersModel->listUsersJson();
            return new Response(200, [], $this->engine->render('admin/users', ['title' => 'Usuários', 'data' => $users]));
        } catch (\PDOException $e) {
            return new Response(500, [], $this->engine->render('admin/users', ['title' => 'Usuários', 'data' => ['error' => $e->getMessage()]]));
        }
    }
}
