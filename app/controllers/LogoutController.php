<?php

namespace app\controllers;
use core\SessionManager;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class LogoutController
{
    public function logout(ServerRequestInterface $request): ResponseInterface
    {
        $sessionManager = SessionManager::getInstance();
        $sessionManager->destroySession();
        return new Response(302, ['Location' => '/login']);
    }
}