<?php

namespace app\helpers;

use core\SessionManager;

function hasPermission($userRole, $permission): bool
{
    if($userRole === null){
        return false;
    }
    $roleAndPermission = ['admin' => ['view', 'delete', 'update'], 'common' => ['view', 'create']];
    return in_array($permission,   $roleAndPermission[$userRole]);
}

function getUserRole(): string
{
    return SessionManager::getInstance()->getUserSession()['perfil'];
}


function view(string $viewName, array $data = [], bool $useLayout = true)
{
    extract($data);

    if ($useLayout) {
        
        require_once base_path("app/view/header.php");
    }

    require_once base_path("app/view/{$viewName}.php");

    if ($useLayout) {
        require_once base_path("app/view/footer.php");
    }
}

function viewJson($data = [], $success = true)
{
    header('Content-Type: application/json');

    if ($success) {
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'error' => $data['error']]);
    }
}
function view404()
{
    http_response_code(404);
    require_once base_path("app/view/404.php");
}

function base_path(string $path = ''): string
{
    return rtrim(__DIR__ . '/../../', '/') . '/' . ltrim($path, '/');
}
