<?php

namespace app\controllers;

use function app\helpers\view;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use League\Plates\Engine;

class UnauthorizedController
{
    private Engine $engine;
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }
    public function unauthorized(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(401, [], $this->engine->render('401'));
    }
}
