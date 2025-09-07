<?php

namespace core;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MiddlewareStack
{
    private $middlewares = [];

    public function add(MiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function process(ServerRequestInterface $request): ?ResponseInterface
    {
        foreach ($this->middlewares as $middleware) {
            $response = $middleware->handle($request);
            if ($response !== null) {
                return $response; // Ex: redirecionamento
            }
        }

        return null; // Nenhuma middleware barrou
    }
}


interface MiddlewareInterface
{
    public function handle(ServerRequestInterface $request): ?ResponseInterface;
}
