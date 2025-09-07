<?php

namespace app\controllers;

use app\model\ViewTaskModel;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use League\Plates\Engine;

class UpdateTaskFormController
{
    private ViewTaskModel $viewTaskModel;
    private Engine $engine;
    public function __construct(ViewTaskModel $viewTaskModel, Engine $engine)
    {
        $this->viewTaskModel = $viewTaskModel;
        $this->engine = $engine;
    }
    public function updateTaskForm(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            return new Response(404, [], $this->engine->render('404'));
        }

        $task = $this->viewTaskModel->getTask($id);
        return new Response(200, [], $this->engine->render('update-task', ['title' => 'Editar chamado', 'data' => $task]));
    }
}
