<?php

declare(strict_types=1);

namespace app\controllers;

use app\model\ListTasksModel;
use core\SessionManager;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    private ?array $user = null;
    private ListTasksModel $listTasksModel;
    private Engine $engine;

    public function __construct(ListTasksModel $listTasksModel, Engine $engine)
    {
        $this->user = SessionManager::getInstance()->getUserSession();
        $this->listTasksModel = $listTasksModel;
        $this->engine = $engine;
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $tasks = $this->listTasksModel->listTasks($this->user['username']);
        if ($this->user['perfil'] === 'admin') {
            return new Response(302, ['Location' => '/home-admin']);
        }
        return new Response(200, [], $this->engine->render('home', ['title' => 'Home', 'data' => $this->user, 'tasks' => $tasks['data'], 'status' => $tasks['status']]));
    }
}
