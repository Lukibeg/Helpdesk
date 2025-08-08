<?php

namespace app\model;

class UsuarioModel{
    public function findById($value)
    {

        $users = [1 => 'Lucas', 2 => 'Erik'];
        foreach ($users as $id => $name) {
            if($value == $id){
                return [$id => $name];
            }
        }
    }
}

