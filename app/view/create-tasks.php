<?php $this->layout('layout'); ?>


<div class="create-helpdesk-container">
    <div class="form-header">
        <h1>📝 Criar Novo Chamado</h1>
        <p>Preencha os campos abaixo para abrir um novo chamado de suporte</p>
    </div>

    <div class="helpdesk">
        <form action="/create-tasks" method="post" class="helpdesk-form">
            <div class="form-group">
                <label for="title">Título do Chamado *</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="Digite um título descritivo para o chamado"
                    required
                    maxlength="100">
                <small class="form-hint">Máximo 100 caracteres</small>
            </div>

            <div class="form-group">
                <label for="description">Descrição Detalhada *</label>
                <textarea
                    id="description"
                    name="description"
                    placeholder="Descreva detalhadamente o problema ou solicitação..."
                    required
                    rows="6"
                    maxlength="1000"></textarea>
                <small class="form-hint">Máximo 1000 caracteres</small>
            </div>


            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="open">Aberto</option>
                    <option value="in-progress">Em Progresso</option>
                    <option value="closed">Resolvido</option>
                    <option value="closed">Fechado</option>
                </select>
            </div>

            <div class="form-group">
                <label for="priority">Prioridade</label>
                <select id="priority" name="priority">
                    <option value="baixa">Baixa</option>
                    <option value="media" selected>Média</option>
                    <option value="alta">Alta</option>
                    <option value="urgente">Urgente</option>
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

            <div class="form-actions">
                <button type="button" class="btn-secondary" onclick="window.location.href='/'">
                    <span>←</span> Voltar
                </button>
                <button type="submit" class="btn-primary">
                    <span>✓</span> Criar Chamado
                </button>
            </div>
        </form>
    </div>
</div>