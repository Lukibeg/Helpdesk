<?php

namespace core;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle()
    {
        if (!array_key_exists('user', $_SESSION) && $_SERVER['REQUEST_URI'] !== '/login') {
            header('Location: /login');
            exit;
        }
    }

}
