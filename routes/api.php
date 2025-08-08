<?php
namespace apiRoutes;
use app\api\UserApiController;

$router->get('/api/v1/usuarios', [UserApiController::class, 'list']);
$router->get('/api/v1/usuarios/{id}', [UserApiController::class, 'show']);
$router->post('/api/v1/usuarios', [UserApiController::class, 'store']);
$router->put('/api/v1/usuarios/{id}', [UserApiController::class, 'update']);
$router->delete('/api/v1/usuarios/{id}', [UserApiController::class, 'destroy']);