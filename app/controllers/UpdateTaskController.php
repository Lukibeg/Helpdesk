<?php

namespace app\controllers;

use app\model\UpdateTasksModel;
use core\SessionManager;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use function app\helpers\hasPermission;


class UpdateTaskController
{
    private static $user = null;
    private UpdateTasksModel $updateTasksModel;
    public function __construct(UpdateTasksModel $updateTasksModel)
    {
        self::$user = SessionManager::getInstance()->getUserSession();
        $this->updateTasksModel = $updateTasksModel;
    }

    public function updateTasks(ServerRequestInterface $request): ResponseInterface
    {
        if (!hasPermission(self::$user['perfil'], 'update')) {
            return new Response(401, [], 'Sem permissão');
        }

        $data = $request->getParsedBody();
        if (!$data) {
            return new Response(400, [], 'Dados inválidos');
        }

        $result = $this->updateTasksModel->updateTasks($data['id'], $data['title'], $data['description'], $data['status'], $data['user_name']);
        if ($result['success']) {
            SessionManager::getInstance()->setSession('edit_success', 1);
            return new Response(200, [], json_encode(['status' => 'success', 'message' => 'Chamado atualizado com sucesso']));
        }
        SessionManager::getInstance()->setSession('edit_error', 1);
        return new Response(500, [], json_encode(['status' => 'error', 'message' => 'Erro ao atualizar chamado']));
    }
}
