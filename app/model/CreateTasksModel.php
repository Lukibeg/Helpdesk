<?php
declare(strict_types=1);

namespace app\model;

class CreateTasksModel
{
    private ?Database $database = null;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function createTasks(string $title, string $description, string $status, string $username, string $priority, string $category): array|bool
    {
        try {
            $pdo = $this->database->connect();
            $stmt = $pdo->prepare('INSERT INTO tasks (title, description, status, user_name, priority, category) VALUES (:title, :description, :status, :user_name, :priority, :category)');
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':user_name', $username);
            $stmt->bindValue(':priority', $priority);
            $stmt->bindValue(':category', $category);
            $result = $stmt->execute();

            if (!$result) {
                throw new \PDOException('Erro ao criar tarefa');
            }
            return ['success' => true, 'message' => 'Tarefa criada com sucesso'];
        } catch (\PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
