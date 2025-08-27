<?php

declare(strict_types=1);

namespace app\controllers;

use app\model\ListTasksModel;
use function app\helpers\view;
use core\SessionManager;


class HomeController
{
    private static ?array $user = null;
    private ListTasksModel $listTasksModel;

    public function __construct(ListTasksModel $listTasksModel)
    {
        self::$user = SessionManager::getInstance()->getUserSession();
        $this->listTasksModel = $listTasksModel;
    }

    public function index(): void
    {
        $tasks = $this->listTasksModel->listTasks(self::$user['username']);
        if (self::$user['perfil'] === 'admin') {
            header('Location: /home-admin');
            exit;
        }
        view('home', ['title' => 'Home', 'data' => self::$user, 'tasks' => $tasks['data'], 'status' => $tasks['status']]);
    }
}
