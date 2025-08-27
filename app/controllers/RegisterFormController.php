<?php

namespace app\controllers;
use function app\helpers\view;

class RegisterFormController
{
    public function registerForm()
    {
        view('register');
    }
}
