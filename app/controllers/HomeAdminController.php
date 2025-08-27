<?php

namespace app\controllers;

use app\model\HomeAdminModel;
use core\SessionManager;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use function app\helpers\hasPermission;
use function app\helpers\view;


class HomeAdminController
{
    private static $user = null;
    private HomeAdminModel $homeAdminModel;
    public function __construct(HomeAdminModel $homeAdminModel)
    {
        self::$user = SessionManager::getInstance()->getUserSession();
        $this->homeAdminModel = $homeAdminModel;
    }
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        if (!hasPermission(self::$user['perfil'], 'delete')) {
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
        return new Response(200, [], view('home-admin', ['title' => 'Home Admin', 'data' => self::$user, 'tasks' => $tasks, 'stats' => $stats]));
    }

    public function tickets(ServerRequestInterface $request): ResponseInterface
    {
        if (!hasPermission(self::$user['perfil'], 'delete')) {
            return new Response(401, [], 'Sem permissão');
        }

        $tasks = $this->homeAdminModel->getAllTasks();
        return new Response(200, [], view('admin/tickets', ['title' => 'Tickets', 'data' => self::$user, 'tasks' => $tasks]));
    }
}
