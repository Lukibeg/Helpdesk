<?php

namespace app\controllers;

use function app\helpers\view;
use function app\helpers\hasPermission;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use League\Plates\Engine;
use core\SessionManager;

class CreateTaskForm
{

    private static $user = null;
    private Engine $engine;

    public function __construct(Engine $engine)
    {
        self::$user = SessionManager::getInstance()->getUserSession();
        $this->engine = $engine;
    }

    public function createTaskForm(): ResponseInterface
    {
        if (!hasPermission(self::$user['perfil'], 'create')) {
            return new Response(302, ['Location' => '/401']);
        }
        return new Response(200, body: $this->engine->render('create-tasks', ['title' => 'Criar tarefa']));
    }
}
