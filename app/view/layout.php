<?php

use core\SessionManager;

//Para verificar se existe um usuário logado
$user = SessionManager::getInstance()->getUserSession();
?>

<!DOCTYPE html>
<html lang="pt-BR">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= 'Chamados' ?></title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body>
    <?php if ($user): ?>
        <header>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/sobre">Sobre</a></li>
                    <li><a href="/usuario">Usuários</a></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </nav>
        </header>
    <?php endif; ?>
    <main>

    <?= $this->section('content'); ?>

    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> Minha Aplicação. Todos os direitos reservados.</p>
    </footer>
    <script src="/assets/js/app.js"></script>
    <?php if ($_SERVER['REQUEST_URI'] == '/view-tasks'): ?>
        <script src="/assets/js/api/viewTaskApi.js"></script>
    <?php endif; ?>
    <?php if ($_SERVER['REQUEST_URI'] == '/admin/tickets'): ?>
        <script src="/assets/js/api/deleteTaskId.js"></script>
    <?php endif; ?>
    <?php if ($_SERVER['REQUEST_URI'] == '/update-task/' . (isset($data['id']) ? $data['id'] : '')): ?>
        <script src="/assets/js/api/updateTaskId.js"></script>
    <?php endif; ?>
</body>

</html>