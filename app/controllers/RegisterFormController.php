<?php

namespace app\controllers;

use function app\helpers\view;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;

class RegisterFormController
{
    private Engine $engine;
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }
    public function registerForm(): ResponseInterface
    {
        return new Response(200, [], $this->engine->render('register'));
    }
}
