<?php

namespace app\controllers;

use core\SessionManager;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;

class LogoutController
{
    public function logout(): ResponseInterface
    {
        $sessionManager = SessionManager::getInstance();
        $sessionManager->destroySession();

        return new Response(302, [
            'Location' => '/login',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }
}
