<!-- app/views/home.php -->
<?php $this->layout('layout'); ?>

<h1>Bem-vindo a página de usuarios, <?php foreach ($data as $id => $name) {
                                        echo "ID: " . htmlspecialchars($id) . " Nome: " . htmlspecialchars($name);
                                    } ?></h1>