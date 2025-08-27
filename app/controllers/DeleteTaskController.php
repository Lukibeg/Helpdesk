<?php

namespace app\controllers;

use app\model\DeleteTasksModel;
use core\SessionManager;
use function app\helpers\hasPermission;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;


class DeleteTaskController
{
    private static $user = null;
    private DeleteTasksModel $deleteTasksModel;
    public function __construct(DeleteTasksModel $deleteTasksModel)
    {
        self::$user = SessionManager::getInstance()->getUserSession();
        $this->deleteTasksModel = $deleteTasksModel;
    }

    public function deleteTasks(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            return new Response(400, [], 'ID inválido');
        }

        if (!hasPermission(self::$user['perfil'], 'delete')) {
            return new Response(401, [], 'Sem permissão');
        }

        $result = $this->deleteTasksModel->deleteTasks($id);

        if ($result) {
            SessionManager::getInstance()->setSession('success', 1);
            return new Response(
                200,
                ['Content-Type' => 'application/json'],
                json_encode(['status' => 'success', 'message' => 'Chamado deletado com sucesso'])
            );
        }

        return new Response(
            500,
            ['Content-Type' => 'application/json'],
            json_encode(['status' => 'error', 'message' => 'Erro ao deletar chamado'])
        );
    }
}
