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