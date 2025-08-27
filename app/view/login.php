<div class="login-container">

    <div class="login-title">
        <h2>Login</h2>
    </div>

    <?php if (isset($_SESSION['flash']['message']) && $_SESSION['flash']['message'] === 'error') : ?>
        <div id="error">
            <p>Usuário ou senha inválidos</p>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>


    <form method="post" action="/login">
        <input type="text" autocomplete="off" class="input-form" name="username" placeholder="Username" required>
        <input type="password" autocomplete="off" id="password" class="input-form" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p style="text-align: center; margin-top: 1rem;">
        <a href="/register">Não tem uma conta? Registre-se</a>
    </p>
</div>