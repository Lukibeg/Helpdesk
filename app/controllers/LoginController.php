<?php

namespace app\controllers;

use function app\helpers\view;
use core\SessionManager;
class LoginController
{
    private ?SessionManager $sessionManager;
    private ?string $username;
    private ?string $password;

    public function __construct()
    {
        $this->sessionManager = SessionManager::getInstance();
    }
    public function login()
    {
        $this->username = $_POST['username'];
        $this->password = $_POST['password'];
 

        if (isset($this->username) && isset($this->password)) {
            $this->sessionManager->setSession('user', $this->username);
            header('Location: /login?success=true');
            exit;
        }

    }

}
