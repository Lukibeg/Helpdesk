<?php
namespace webRoutes;

use app\controllers\HomeController;
use app\controllers\UsuarioController;
use app\controllers\ListUsersController;
use app\controllers\LoginController;
use app\controllers\LoginFormController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/sobre', [HomeController::class, 'sobre']);
$router->get('/usuario/{id}', [UsuarioController::class, 'show']);
$router->get('/login', [LoginFormController::class, 'loginForm']);
$router->post('/login', [LoginController::class, 'login']);

