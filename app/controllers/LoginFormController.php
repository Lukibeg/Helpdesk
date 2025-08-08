<?php

namespace app\controllers;
use function app\helpers\view;

class LoginFormController
{
    public function loginForm()
    {
        view('login');
    }
}
