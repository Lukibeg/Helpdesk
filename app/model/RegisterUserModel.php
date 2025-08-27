<?php

namespace app\model;

class RegisterUserModel
{

    private ?string $username;
    private ?string $password;
    private ?string $email;
    private ?string $perfil;
    private ?Database $database = null;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function registerUser($username, $password, $email, $perfil): array
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->perfil = $perfil;

        try {
            $pdo = $this->database->connect();
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email, perfil) VALUES (?, ?, ?, ?)");
            $result = $stmt->execute([$this->username, $this->password, $this->email, $this->perfil]);
            if ($result) {
                return ['status' => 'success', 'message' => 'Usuário registrado com sucesso'];
            }

            return ['status' => 'error', 'message' => 'Erro ao registrar usuário'];
        } catch (\PDOException $e) {
            return ['status' => 'error', 'message' => 'Erro ao registrar usuário: ' . $e->getMessage()];
        }
    }
}
