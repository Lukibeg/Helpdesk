<?php

namespace app\controllers;
use function app\helpers\view;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class UnauthorizedController
{
    public function unauthorized(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(401, [], view('401'));
    }
}
