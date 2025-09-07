<?php

namespace core;

use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(ServerRequestInterface $request): ?ResponseInterface
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = $uri;

        if (!array_key_exists('user', $_SESSION) && $uri !== '/login' && $uri !== '/register') {
            return new Response(302, ['Location' => '/login']);
        }

        if (array_key_exists('user', $_SESSION) && $uri === '/login') {
            return new Response(302, ['Location' => '/']);
        }

        // Se for rota protegida, diz pro browser não guardar
        if (!in_array($path, ['/login', '/register'])) {
            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            header('Pragma: no-cache');
            header('Expires: 0');
        }

        // Nenhum problema -> deixa o fluxo seguir
        return null;
    }
}
