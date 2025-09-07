<?php
require_once __DIR__ . '/../app/utils/bootstrap.php';

use core\Router;
use core\MiddlewareStack;
use core\SessionManager;
use function app\helpers\view404;
use function app\helpers\viewJson;

SessionManager::getInstance();

$middlewareStack = new MiddlewareStack();
$middlewareStack->add(new core\AuthMiddleware());

require_once __DIR__ . '/../core/Container.php';
$router = new Router($container);

require_once __DIR__ . '/../routes/api.php';
require_once __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$isApi = strpos($uri, '/api/') === 0;

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$serverRequest = $creator->fromGlobals();

$response = $middlewareStack->process($serverRequest);

if ($response !== null) {
    http_response_code($response->getStatusCode());
    foreach ($response->getHeaders() as $name => $values) {
        foreach ($values as $value) {
            header("$name: $value", false);
        }
    }
    echo $response->getBody();
    exit;
}

$response = $router->dispatch($uri, $method, $serverRequest);
http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header("$name: $value", false);
    }
}

echo $response->getBody();
exit;

if ($response !== null) {
    if ($isApi) {
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Endpoint não encontrado']);
    } else {
        view404();
    }
}
