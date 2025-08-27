<?php

namespace app\controllers;

use app\model\ViewTaskModel;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use function app\helpers\view;

class ViewTaskController
{
    private ViewTaskModel $viewTaskModel;
    public function __construct(ViewTaskModel $viewTaskModel)
    {
        $this->viewTaskModel = $viewTaskModel;
    }
    public function viewTask(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            return new Response(400, [], 'ID inválido');
        }
        $task = $this->viewTaskModel->getTask($id);
        return new Response(200, [], view('view-tasks', ['title' => 'Chamado', 'data' => $task]));
    }
}
