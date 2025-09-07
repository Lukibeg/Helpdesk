<?php

namespace app\controllers;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;

class LoginFormController
{
    private Engine $engine;
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }
    public function loginForm(): ResponseInterface
    {
        return new Response(200, body: $this->engine->render('login', ['title' => 'Login']));
    }
}
