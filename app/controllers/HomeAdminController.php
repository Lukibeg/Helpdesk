<?php

namespace app\controllers;

use app\model\HomeAdminModel;
use core\SessionManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response;
use function app\helpers\hasPermission;
use League\Plates\Engine;


class HomeAdminController
{
    private ?array $user = null;
    private Engine $engine;
    private HomeAdminModel $homeAdminModel;
    public function __construct(HomeAdminModel $homeAdminModel, Engine $engine)
    {
        $this->user = SessionManager::getInstance()->getUserSession();
        $this->engine = $engine;
        $this->homeAdminModel = $homeAdminModel;
    }
    public function index(ServerRequestInterface $request): ResponseInterface
    {

        if (!hasPermission($this->user['perfil'], 'delete')) {
            return new Response(401, [], 'Sem permissão');
        }

        $tasks = $this->homeAdminModel->getAllTasks();
        $users = [];
        $stats = ['total_tickets' => 0, 'open_tickets' => 0, 'closed_tickets' => 0, 'active_users' => 0];
        foreach ($tasks['data'] as $task) {
            $stats['total_tickets']++;
            if ($task['status'] === 'in-progress') {
                $stats['open_tickets']++;
            } else if ($task['status'] === 'closed') {
                $stats['closed_tickets']++;
            }
            if (!in_array($task['user_name'], $users)) {
                $users[] = $task['user_name'];
            }
        }
        $stats['active_users'] = count($users);
        return new Response(200, [], $this->engine->render('home-admin', ['title' => 'Home Admin', 'data' => $this->user, 'tasks' => $tasks, 'stats' => $stats]));
    }

    public function tickets(ServerRequestInterface $request): ResponseInterface
    {

        if (!hasPermission($this->user['perfil'], 'delete')) {
            return new Response(401, [], 'Sem permissão');
        }

        $tasks = $this->homeAdminModel->getAllTasks();
        return new Response(200, [], $this->engine->render('admin/tickets', ['title' => 'Tickets', 'data' => $this->user, 'tasks' => $tasks]));
    }
}
