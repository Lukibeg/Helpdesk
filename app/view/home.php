    <!-- app/view/home.php -->
    <?php

    use function app\helpers\hasPermission;

    ?>

    <div class="home-container">
        <h1>Bem-vindo, <?= htmlspecialchars($data['username'] ?? 'Usuário') ?>!</h1>
        <h2>Aqui você pode abrir ou ver chamados que estão abertos</h2>

        <?php if (isset($_SESSION['create_task_success'])) : ?>
            <div class="alert alert-success">
                <p>Chamado criado com sucesso</p>
            </div>
            <?php unset($_SESSION['create_task_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['create_task_error'])) : ?>
            <div class="alert alert-danger">
                <p>Erro ao criar chamado</p>
            </div>
            <?php unset($_SESSION['create_task_error']); ?>
        <?php endif; ?>


        <div class="helpdesk">
            <h3>Chamados abertos</h3>
            <p>Aqui você pode ver os chamados que estão abertos e vinculados a você!</p>

            <div class="helpdesk-list">
                <?php if (empty($tasks) || isset($status) == false): ?>
                    <div class="helpdesk-item">
                        <h4>Nenhum chamado encontrado</h4>
                        <h5>Não há chamados abertos no momento.</h5>
                    </div>
                <?php else: ?>


                    <?php foreach ($tasks as $task): ?>
                        <div class="helpdesk-item">
                            <h4><?= htmlspecialchars($task['title']) ?></h4>
                            <h5><?= htmlspecialchars($task['description']) ?></h5>
                            <h6>
                                Status:
                                <span class="status-badge status-<?= strtolower($task['status']) ?>">
                                    <?= htmlspecialchars($task['status']) ?>
                                </span>
                            </h6>
                            <h6>Usuário: <?= htmlspecialchars($task['user_name']) ?></h6>
                            <h6>Data de criação: <?= htmlspecialchars($task['created_at']) ?></h6>
                            <a href="/view-tasks/<?= $task['id'] ?>">Ver chamado</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if (hasPermission($data['perfil'], 'create')): ?>
                <div class="create-button">
                    <button onclick="window.location.href='/create-tasks'">
                        Abrir chamado
                    </button>
                </div>
            <?php endif ?>
        </div>

        <?php if (isset($error)): ?>
            <div id="error">
                <p><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>
    </div>