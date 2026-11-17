<?php

/*
| Valores específicos da máquina (senha do banco, URL, ambiente) ficam em
| config.local.php, que não deve ser versionado. Veja config.local.example.php.
*/
if (file_exists(__DIR__ . '/config.local.php')) {
    require_once __DIR__ . '/config.local.php';
}

defined('APP_NAME') || define('APP_NAME', 'cybersec');

// 'development' mostra detalhes de erros; qualquer outro valor esconde.
defined('APP_ENV') || define('APP_ENV', 'production');

defined('BASE_URL') || define('BASE_URL', 'http://localhost/cybersec/public');

defined('DB_HOST') || define('DB_HOST', 'localhost');
defined('DB_NAME') || define('DB_NAME', 'cybersec');
defined('DB_USER') || define('DB_USER', 'root');
defined('DB_PASS') || define('DB_PASS', '');

define('UPLOAD_PATH', __DIR__ . '/../public/assets/uploads/profiles/');
define('UPLOAD_MAX_BYTES', 2 * 1024 * 1024);

date_default_timezone_set('America/Sao_Paulo');
