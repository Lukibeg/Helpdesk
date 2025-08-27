<?php

namespace app\controllers;

use function app\helpers\hasPermission;
use core\SessionManager;
use app\model\CreateTasksModel;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class CreateTaskController
{
    private static $user = null;
    private CreateTasksModel $createTasksModel;
    public function __construct(CreateTasksModel $createTasksModel)
    {
        self::$user = SessionManager::getInstance()->getUserSession();
        $this->createTasksModel = $createTasksModel;
    }

    public function createTasks(ServerRequestInterface $request): ResponseInterface
    {

        $data = $request->getParsedBody();

        if (!hasPermission(self::$user['perfil'], 'create')) {
            return new Response(401, ['Location' => '/401']);
        }


        if ($data) {
            $title = $data['title'];
            $description = $data['description'];
            $status = $data['status'];
            $priority = $data['priority'];
            $category = $data['category'];
        } else {
            SessionManager::getInstance()->setSession('create_task_error', 'Preencha todos os campos obrigatórios');
            return new Response(403, ['Location' => '/']);
        }

        $result = $this->createTasksModel->createTasks($title, $description, $status, self::$user['username'], $priority, $category);
        if ($result) {
            SessionManager::getInstance()->setSession('create_task_success', 'Tarefa criada com sucesso');
            return new Response(200, ['Location' => '/']);
        } else {
            SessionManager::getInstance()->setSession('create_task_error', 'Erro ao criar tarefa');
            return new Response(403, ['Location' => '/']);
        }
    }
}
