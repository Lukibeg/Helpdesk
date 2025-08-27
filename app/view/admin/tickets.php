<div class="admin-tickets-container">
    <div class="helpdesk">

        <!-- Delete -->
        <?php if (isset($_SESSION['success']) && $_SESSION['success'] == 1): ?>
            <div class="success-message">
                <p>Chamado deletado com sucesso!</p>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>


        <?php if (isset($_SESSION['error']) && $_SESSION['error'] == 1): ?>
            <div class="error-message">
                <p>Chamado não pôde ser deletado com sucesso!</p>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <!-- End Delete -->

        <!-- Edit -->
        <?php if (isset($_SESSION['edit_success']) && $_SESSION['edit_success'] == 1): ?>
            <div class="success-message">
                <p>Chamado atualizado com sucesso!</p>
            </div>
            <?php unset($_SESSION['edit_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['edit_error']) && $_SESSION['edit_error'] == 1): ?>
            <div class="error-message">
                <p>Chamado não pôde ser atualizado com sucesso!</p>
            </div>
            <?php unset($_SESSION['edit_error']); ?>
        <?php endif; ?>
        <!-- End Edit -->

        <!-- List -->
        <div class="helpdesk-list">
            <h3>Chamados abertos</h3>
            <p>Painel do administrador para gerenciar os chamados</p>
            <!-- Se não houver chamados abertos -->
            <?php if (empty($tasks)): ?>
                <div class="helpdesk-item">
                    <h4>Nenhum chamado encontrado</h4>
                    <h5>Não há chamados abertos no momento.</h5>
                </div>
            <?php else: ?>


                <?php if (!isset($_GET['type'])): ?>
                    <?php foreach ($tasks['data'] as $task): ?>
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
                            <h6>
                                <a href="/view-tasks/<?= $task['id'] ?>"><span class="material-symbols-outlined view-task" onmouseover="tooltip(45, 'view-task', 'Visualizar Chamado')">
                                        visibility
                                    </span></a>
                                <a href="/update-task/<?= $task['id'] ?>"><span class="material-symbols-outlined update-task" onmouseover="tooltip(75, 'update-task', 'Atualizar Chamado')">
                                        edit_note
                                    </span></a>
                                <a href="#" class="delete-task-button" data-id="<?= $task['id'] ?>"><span class="material-symbols-outlined delete-task" onmouseover="tooltip(105, 'delete-task', 'Deletar Chamado')">
                                        delete
                                    </span></a>
                            </h6>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (isset($_GET['type']) && $_GET['type'] === 'pending'): ?>
                    <?php foreach ($tasks['data'] as $task): ?>
                        <?php if ($task['status'] === 'in-progress'): ?>
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
                                <h6>
                                    <a href="/view-tasks/<?= $task['id'] ?>"><span class="material-symbols-outlined view-task" onmouseover="tooltip(45, 'view-task', 'Visualizar Chamado')">
                                            visibility
                                        </span></a>
                                    <a href="/update-task/<?= $task['id'] ?>"><span class="material-symbols-outlined update-task" onmouseover="tooltip(75, 'update-task', 'Atualizar Chamado')">
                                            edit_note
                                        </span></a>
                                    <a href="#" class="delete-task-button" data-id="<?= $task['id'] ?>"><span class="material-symbols-outlined delete-task" onmouseover="tooltip(105, 'delete-task', 'Deletar Chamado')">
                                            delete
                                        </span></a>
                                </h6>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <!-- End List -->
    </div>
</div>