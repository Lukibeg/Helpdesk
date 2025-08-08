<?php

namespace app\model;
use app\model\Database;

class UserModel{
    public function getUser(){
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM users");
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}