<?php

namespace app\model;

use app\model\Database;

class HomeAdminModel
{
    private ?Database $database = null;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAllTasks()
    {
        $pdo = $this->database->connect();
        try {
            $stmt = $pdo->query("SELECT * FROM tasks");
            $tasks = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return ['success' => true, 'data' => $tasks];
        } catch (\PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
