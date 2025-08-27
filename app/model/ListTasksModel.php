<?php

namespace app\model;

use app\model\Database;
use core\SessionManager;

class ListTasksModel
{
    private ?string $username = null;
    private ?Database $database = null;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function listTasks(string $username): ?array
    {
        try {
            $pdo = $this->database->connect();
            $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_name = :username");
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return ['status' => true, 'data' => $result];
        } catch (\PDOException $e) {
            return ['status' => false, 'error' => $e->getMessage()];
        }
    }
}
