<?php

namespace app\controllers;

use core\SessionManager;
use app\model\LoginModel;
use Psr\Http\Message\ResponseInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class LoginController
{

    use \app\helpers\FlashMessages;
    private ?SessionManager $sessionManager;
    private ?string $username;
    private ?string $password;
    private LoginModel $loginModel;

    public function __construct(LoginModel $loginModel)
    {
        $this->sessionManager = SessionManager::getInstance();
        $this->loginModel = $loginModel;
    }

    private function setUser($value)
    {
        $this->username = $value;
    }

    private function setPassword($value)
    {
        $this->password = $value;
    }

    private function getUser()
    {
        return $this->username;
    }

    private function getPassword()
    {
        return $this->password;
    }


    public function login(ServerRequestInterface $request): ResponseInterface
    {

        $data = $request->getParsedBody();
        $this->setUser($data['username'] ?? '');
        $this->setPassword($data['password'] ?? '');

        if (empty($this->getUser()) || empty($this->getPassword())) {
            return new Response(302, ['Location' => '/login?error=true']);
        }

        if ($this->getUser() != null && $this->getPassword() != null) {
            $result = $this->loginModel->login($this->getUser(), $this->getPassword());
            if ($result['status'] === 'success') {
                $this->sessionManager->regenerateSession();
                $this->sessionManager->setSession('user', $result['data']);
                if ($result['data']['perfil'] === 'admin') {
                    return new Response(302, ['Location' => '/home-admin']);
                } else {
                    return new Response(302, ['Location' => '/']);
                }
            } else {
                $this->setFlash('error', 'Credenciais inválidas');
                return new Response(302, ['Location' => '/login']);
            }
        }
        return new Response(302, ['Location' => '/login']);
    }
}
