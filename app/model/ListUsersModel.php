<?php

namespace app\model;

use app\model\Database;

class ListUsersModel
{
    private ?Database $database = null;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function listUsersJson()
    {
        $pdo = $this->database->connect();

        try {
            $stmt = $pdo->query("SELECT id, username, email, perfil FROM users");
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return ['status' => 'success', 'data' => $result];
        } catch (\PDOException $e) {
            $debug = $_ENV['APP_DEBUG'] ?? false;
            if ($debug) {
                return ['success' => false, 'error' => 'Erro ao buscar usuários: ' . $e->getMessage()];
            } else {
                return ['success' => false, 'error' => 'Erro interno do servidor. Tente novamente mais tarde.'];
            }
        }
    }
}
