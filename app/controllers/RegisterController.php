<?php

namespace app\controllers;

use app\model\RegisterUserModel;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class RegisterController
{
    private RegisterUserModel $registerUserModel;
    public function __construct(RegisterUserModel $registerUserModel)
    {
        $this->registerUserModel = $registerUserModel;
    }

    public function register(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        if (array_key_exists('username', $data) && array_key_exists('password', $data) && array_key_exists('email', $data) && array_key_exists('perfil', $data)) {

            if (empty($data['username']) || empty($data['password']) || empty($data['email'])) {
                return new Response(302, ['Location' => '/register?error=true']);
            } else {
                $password = password_hash($data['password'], PASSWORD_ARGON2I);
                $result = $this->registerUserModel->registerUser($data['username'], $password, $data['email'], $data['perfil']);
                if ($result['status'] === 'success') {
                    return new Response(302, ['Location' => '/login?success=true']);
                } else {
                    return new Response(302, ['Location' => '/register?error=true']);
                }
            }
        }
        return new Response(302, ['Location' => '/register?error=true']);
    }
}
