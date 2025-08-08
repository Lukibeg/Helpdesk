<?php

namespace app\model;

use app\model\Database;

class HomeModel
{
    public function getUsers()
    {
        $pdo = Database::connect();

        try {
            $stmt = $pdo->query("SELECT * FROM userss");
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return ['success' => true, 'data' => $result];
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
