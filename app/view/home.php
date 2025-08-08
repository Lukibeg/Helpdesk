<!-- app/view/home.php -->
<h1>Bem-vindo, <?= htmlspecialchars($nome) ?>!</h1>
<h2>Aqui está a lista de usuários:</h2>

<?php if (isset($users['success']) && $users['success'] === false): ?>
    <div class="error"><?= htmlspecialchars($users['error']) ?></div>
<?php elseif (isset($users['data']) && !empty($users['data'])): ?>
    <?php foreach ($users['data'] as $user): ?>
        <p><?= htmlspecialchars($user['username']) ?></p>
    <?php endforeach; ?>
<?php else: ?>
    <p>Nenhum usuário encontrado.</p>
<?php endif; ?>

<hr>
<p>Esta é a página inicial da aplicação.</p>

<button id="listar-usuarios">Clique aqui para listar os usuários</button>
<div id="users"></div>
<div id="error"></div>