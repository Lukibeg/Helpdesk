<div class="home-admin-container">
    <div class="admin-header">
        <h1>👨‍💼 Painel Administrativo</h1>
        <h2>Bem-vindo, <?= htmlspecialchars($data['username'] ?? 'Administrador') ?>!</h2>
        <p>Gerencie todos os chamados e usuários do sistema</p>
    </div>

    <div class="admin-stats">
        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-content">
                <h3>Total de Chamados</h3>
                <span class="stat-number"><?= isset($stats['total_tickets']) ? $stats['total_tickets'] : '0' ?></span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🔴</div>
            <div class="stat-content">
                <h3>Chamados Abertos</h3>
                <span class="stat-number"><?= isset($stats['open_tickets']) ? $stats['open_tickets'] : '0' ?></span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🟢</div>
            <div class="stat-content">
                <h3>Chamados Fechados</h3>
                <span class="stat-number"><?= isset($stats['closed_tickets']) ? $stats['closed_tickets'] : '0' ?></span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-content">
                <h3>Usuários Ativos</h3>
                <span class="stat-number"><?= isset($stats['active_users']) ? $stats['active_users'] : '0' ?></span>
            </div>
        </div>
    </div>

    <div class="admin-actions">
        <div class="action-section">
            <h3>🎫 Gerenciar Chamados</h3>
            <div class="action-buttons">
                <button class="action-btn primary" onclick="window.location.href='/admin/tickets'">
                    <span>📋</span>
                    Ver Todos os Chamados
                </button>
                <button class="action-btn secondary" onclick="window.location.href='/admin/tickets?type=pending'">
                    <span>⏳</span>
                    Chamados Pendentes
                </button>
                <button class="action-btn success" onclick="window.location.href='/admin/tickets/urgent'">
                    <span>🚨</span>
                    Chamados Urgentes
                </button>
            </div>
        </div>

        <div class="action-section">
            <h3>👥 Gerenciar Usuários</h3>
            <div class="action-buttons">
                <button class="action-btn primary" onclick="window.location.href='/admin/users'">
                    <span>👤</span>
                    Listar Usuários
                </button>
                <button class="action-btn secondary" onclick="window.location.href='/admin/users/create'">
                    <span>➕</span>
                    Criar Usuário
                </button>
                <button class="action-btn warning" onclick="window.location.href='/admin/users/roles'">
                    <span>🔐</span>
                    Gerenciar Permissões
                </button>
            </div>
        </div>

        <div class="action-section">
            <h3>📈 Relatórios</h3>
            <div class="action-buttons">
                <button class="action-btn info" onclick="window.location.href='/admin/reports'">
                    <span>📊</span>
                    Relatórios Gerais
                </button>
                <button class="action-btn secondary" onclick="window.location.href='/admin/reports/performance'">
                    <span>⚡</span>
                    Performance do Sistema
                </button>
            </div>
        </div>
    </div>

    <div class="recent-activity">
        <h3>🕒 Atividade Recente</h3>
        <div class="activity-list">
            <?php if (isset($recent_activity) && !empty($recent_activity)): ?>
                <?php foreach ($recent_activity as $activity): ?>
                    <div class="activity-item">
                        <div class="activity-icon"><?= $activity['icon'] ?? '📝' ?></div>
                        <div class="activity-content">
                            <p class="activity-text"><?= htmlspecialchars($activity['description']) ?></p>
                            <span class="activity-time"><?= htmlspecialchars($activity['time']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="activity-item">
                    <div class="activity-icon">📝</div>
                    <div class="activity-content">
                        <p class="activity-text">Nenhuma atividade recente</p>
                        <span class="activity-time">Agora</span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>