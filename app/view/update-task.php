<?php $this->layout('layout'); ?>

<div class="create-helpdesk-container">
    <div class="form-header">
        <h1>📝 Editar Chamado</h1>
        <p>Preencha os campos abaixo para editar o chamado</p>
    </div>

    <form action="/create-tasks" method="post" class="helpdesk-form">
        <div class="form-group">
            <label for="title">Título do Chamado *</label>
            <input type="text" id="title" name="title" value="<?= $data['title'] ?>" required maxlength="100">

        </div>

        <div class="form-group">
            <label for="description">Descrição Detalhada *</label>
            <textarea type="text" id="description" name="description" required maxlength="1000"><?= $data['description'] ?></textarea>
            <small class="form-hint">Máximo 1000 caracteres</small>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" value="<?= $data['status'] ?>">
                <?php if ($data['status'] == 'open') : ?>
                    <option value="open" selected>Aberto</option>
                <?php elseif ($data['status'] == 'in-progress') : ?>
                    <option value="in-progress" selected>Em Progresso</option>
                <?php elseif ($data['status'] == 'solved') : ?>
                    <option value="solved" selected>Resolvido</option>
                <?php elseif ($data['status'] == 'closed') : ?>
                    <option value="closed" selected>Fechado</option>
                <?php endif; ?>
                <option value="open">Aberto</option>
                <option value="in-progress">Em Progresso</option>
                <option value="solved">Resolvido</option>
                <option value="closed">Fechado</option>
            </select>
        </div>

        <div class="form-group">
            <label for="category">Categoria</label>
            <select id="category" name="category">
                <option value="suporte">Suporte Técnico</option>
                <option value="bug">Reportar Bug</option>
                <option value="melhoria">Sugestão de Melhoria</option>
                <option value="duvida">Dúvida</option>
                <option value="outro">Outro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="created_at" class="label-view-form">Data de criação</label>
            <input type="text" name="created_at" value="<?= $data['created_at'] ?>" disabled>
        </div>

        <div class="form-group">
            <label for="updated_at" class="label-view-form">Data de última atualização</label>
            <input type="text" name="updated_at" value="<?= $data['updated_at'] ?>" disabled>
        </div>

        <div class="form-actions">
            <button type="button" class="btn-secondary" onclick="window.location.href='/admin/tickets'">
                <span>←</span> Voltar
            </button>
            <button class="update-task-button btn-primary" data-id="<?= $data['id'] ?>">Atualizar</button>
        </div>
    </form>
</div>