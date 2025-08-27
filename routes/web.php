<?php

namespace webRoutes;

use app\controllers\HomeController;
use app\controllers\HomeAdminController;
use app\controllers\UsuarioController;
use app\controllers\RegisterController;
use app\controllers\LoginController;
use app\controllers\RegisterFormController;
use app\controllers\LoginFormController;
use app\controllers\ListUsersController;
use app\controllers\LogoutController;
use app\controllers\DeleteTaskController;
use app\controllers\UpdateTaskController;
use app\controllers\CreateTaskController;
use app\controllers\CreateTaskForm;
use app\controllers\UnauthorizedController;
use app\controllers\UpdateTaskFormController;
use app\controllers\ListUserController;


$router->get('/', [HomeController::class, 'index']);
$router->get('/401', [UnauthorizedController::class, 'unauthorized']);
$router->get('/login', [LoginFormController::class, 'loginForm']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LogoutController::class, 'logout']);
$router->post('/register', [RegisterController::class, 'register']);
$router->get('/register', [RegisterFormController::class, 'registerForm']);
$router->get('/create-tasks', [CreateTaskForm::class, 'createTaskForm']);
$router->post('/create-tasks', [CreateTaskController::class, 'createTasks']);
$router->get('/home-admin', [HomeAdminController::class, 'index']);
$router->get('/admin/tickets', [HomeAdminController::class, 'tickets']);
$router->delete('/admin/tickets/{id}', [DeleteTaskController::class, 'deleteTasks']);
$router->get('/update-task/{id}', [UpdateTaskFormController::class, 'updateTaskForm']);
$router->put('/admin/tickets/{id}', [UpdateTaskController::class, 'updateTasks']);
$router->get('/admin/users', [ListUserController::class, 'listUsers']);
