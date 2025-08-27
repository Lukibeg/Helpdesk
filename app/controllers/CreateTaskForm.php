<?php

namespace app\controllers;
use function app\helpers\view;
use function app\helpers\hasPermission;
use core\SessionManager;

class CreateTaskForm
{
    private static $user = null;

    public function __construct()
    {
        self::$user = SessionManager::getInstance()->getUserSession();
    }

    public function createTaskForm()
    {
        if (!hasPermission(self::$user['perfil'], 'create')) {
            header('Location: /401');
            exit;
        }
        view('create-tasks', ['title' => 'Criar tarefa']);
    }
}
