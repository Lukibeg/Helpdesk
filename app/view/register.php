<div class="login-container">
    <div class="login-title">
        <h2>Register</h2>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'true') : ?>
        <div id="error">
            <p>Erro ao registrar usuário</p>
        </div>
    <?php endif; ?>

    <div class="login-form">
        <form method="post" action="/register">
            <label for="username">Username:</label>
            <input class="input-form" type="text" name="username" placeholder="Username">
            <label for="password">Password:</label>
            <input class="input-form" type="password" name="password" placeholder="Password">
            <label for="email">Email:</label>
            <input class="input-form" type="email" name="email" placeholder="Email">
            <label for="perfil">Perfil:</label>
            <select name="perfil">
                <option value="admin">Admin</option>
                <option value="common">Common</option>
            </select>
            <button type="submit">Register</button>
        </form>
    </div>
</div>