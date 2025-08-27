<?php

namespace core;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Container\ContainerInterface;

class Router
{
    private array $routes = [];
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function get(string $uri, array $action)
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, array $action)
    {
        $this->addRoute('POST', $uri, $action);
    }

    public function delete(string $uri, array $action)
    {
        $this->addRoute('DELETE', $uri, $action);
    }

    public function put(string $uri, array $action)
    {
        $this->addRoute('PUT', $uri, $action);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    private function addRoute(string $method, string $uri, array $action)
    {
        // Captura nomes dos placeholders {id}, {slug}, etc.
        preg_match_all('/\{([a-zA-Z_]+)\}/', $uri, $paramNames);

        $pattern = preg_replace('/\{[a-zA-Z_]+\}/', '([a-zA-Z0-9_-]+)', $uri);
        $pattern = "#^" . $pattern . "$#";

        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'controller' => $action[0],
            'method_name' => $action[1],
            'params' => $paramNames[1], // guarda os nomes!
        ];
    }

    public function dispatch(string $requestUri, string $requestMethod, ServerRequestInterface $request): ResponseInterface
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['pattern'], $requestUri, $matches)) {
                array_shift($matches); // remove full match

                // agora já temos os nomes salvos em $route['params']
                foreach ($matches as $index => $value) {
                    $name = $route['params'][$index] ?? null;
                    if ($name) {
                        $request = $request->withAttribute($name, $value);
                    }
                }

                $controller = $this->container->get($route['controller']);
                $response = $controller->{$route['method_name']}($request);

                if (!$response instanceof ResponseInterface) {
                    return new Response(200, [], (string)$response);
                }

                return $response;
            }
        }

        return new Response(404, [], '404 - Not Found');
    }
}
