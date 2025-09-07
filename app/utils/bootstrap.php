<?php
// utils/bootstrap.php

// Carregar autoload
require_once __DIR__ . '/../../vendor/autoload.php';

// Carregar variáveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// Carregar helpers
require_once __DIR__ . '/../../app/helpers/view.php';
require_once __DIR__ . '/../../app/helpers/FlashMessages.php';

// Configurações globais
error_reporting(E_ALL);
ini_set('display_errors', $_ENV['APP_DEBUG'] ?? '1');

// Timezone
date_default_timezone_set('America/Sao_Paulo');