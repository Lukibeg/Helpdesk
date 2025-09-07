<?php

namespace app\controllers;

use app\model\RegisterUserModel;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use \app\helpers\FlashMessages;

class RegisterController
{
    use FlashMessages;
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
                $this->setFlash('Erro ao cadastrar usuário', 'error');
                return new Response(302, ['Location' => '/register']);
            } else {
                $password = password_hash($data['password'], PASSWORD_ARGON2I);
                $result = $this->registerUserModel->registerUser($data['username'], $password, $data['email'], $data['perfil']);
                if ($result['status'] === 'success') {
                    $this->setFlash('Usuário cadastrado com sucesso', 'error');
                    return new Response(302, ['Location' => '/login']);
                } else {
                    $this->setFlash('Erro ao cadastrar usuário', 'error');
                    return new Response(302, ['Location' => '/register']);
                }
            }
        }
        return new Response(302, ['Location' => '/register']);
    }
}
