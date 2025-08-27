<?php

namespace app\model;

use app\model\Database;

class ViewTaskModel
{
    private ?Database $database = null;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function getTask($id): array
    {
        try {
            $pdo = $this->database->connect();
            $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return ['error' => 'Erro ao buscar chamado', 'message' => $e->getMessage()];
        }
    }
}
