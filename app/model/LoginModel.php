<?php

namespace app\model;

use app\model\Database;

class LoginModel
{
    private ?Database $database = null;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function login($username, $password): array
    {
        try {
            $pdo = $this->database->connect();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (empty($result)) {
                return ['status' => 'error', 'message' => 'Usuário ou senha inválidos'];
            }
            if (password_verify($password, $result['password'])) {
                unset($result['password']);
                return ['status' => 'success', 'message' => 'Login realizado com sucesso', 'data' => $result];
            } else {
                return ['status' => 'error', 'message' => 'Usuário ou senha inválidos'];
            }
        } catch (\PDOException $e) {
            return ['status' => 'error', 'message' => 'Erro ao fazer login: ' . $e->getMessage()];
        }
    }
}
