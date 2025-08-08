<?php

namespace app\controllers;

use function app\helpers\view;
use app\model\UsuarioModel;


class UsuarioController
{
    public function show($id)
    {
        
        $usuarioModel = new UsuarioModel;
        $data = $usuarioModel->findById($id);

        if ($data) {
            view('usuario', $data);
        } else {
            echo "Usuário não encontrado!";
        }
    }
}
