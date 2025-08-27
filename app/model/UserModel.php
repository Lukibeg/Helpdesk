<?php

namespace app\model;

use app\model\Database;

class UserModel
{
    private ?Database $database = null;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function getUser(): array
    {
        $pdo = $this->database->connect();
        $stmt = $pdo->query("SELECT * FROM users");
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}
