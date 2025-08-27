<?php

namespace core;
//Quando eu passo parâmetros para /login?error=true, o middleware me redireciona para /login.
//Quando eu passo parâmetros para /register?error=true, o middleware me redireciona para /register.
//Quando eu passo parâmetros para /login?success=true, o middleware me redireciona para /login.
//Quando eu passo parâmetros para /register?success=true, o middleware me redireciona para /register.
//O ideal é que o middleware permita a esses parâmetros serem passados para a página.

class AuthMiddleware implements MiddlewareInterface
{
    public function handle()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!array_key_exists('user', $_SESSION) && $uri !== '/login' && $uri !== '/register') {
            header('Location: /login');
            exit;
        }

        if (array_key_exists('user', $_SESSION) && $uri === '/login') {
            header('Location: /');
            exit;
        }
    }
}
