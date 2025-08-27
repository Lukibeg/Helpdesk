<?php

namespace app\model;

use app\model\Database;

class DeleteTasksModel
{
    private ?Database $database = null;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function deleteTasks($id): bool
    {
        $pdo = $this->database->connect();
        $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();
        return $result;
    }
}
