<?php

namespace app\model;

use core\SessionManager;
use app\model\Database;

class UpdateTasksModel
{
    private ?Database $database = null;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function updateTasks($id, $title, $description, $status, $user_name): array
    {
        try {
            $pdo = $this->database->connect();
            $stmt = $pdo->prepare('UPDATE tasks SET title = :title, description = :description, status = :status, user_name = :user_name WHERE id = :id');
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':user_name', $user_name);

            $result = $stmt->execute();

            if (!$result) {
                throw new \PDOException('Erro ao atualizar tarefa');
            }

            return ['success' => true, 'message' => 'Tarefa atualizada com sucesso'];
        } catch (\PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
