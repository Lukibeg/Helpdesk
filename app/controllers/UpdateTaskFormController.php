<?php

namespace app\controllers;

use app\model\ViewTaskModel;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use function app\helpers\view;


class UpdateTaskFormController
{
    public function updateTaskForm(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            return new Response(400, [], 'ID inválido');
        }
        $viewTaskModel = new ViewTaskModel();
        $task = $viewTaskModel->getTask($id);
        return new Response(200, [], view('update-task', ['title' => 'Editar chamado', 'data' => $task]));
    }
}
