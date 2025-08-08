<?php

namespace app\controllers;
use app\model\HomeModel;
use function app\helpers\view;


class HomeController
{

    public function index()
    {
        $homeModel = new HomeModel();
        $users = $homeModel->getUsers();
        $nome = 'Lucas';
        $title = 'Home';
        view('home', ['title' => $title, 'nome' => $nome, 'users' => $users]);
    }

    public function sobre()
    {
        echo "Sobre nós!";
    }
}
