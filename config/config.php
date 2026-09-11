<?php

define('APP_NAME', getenv('APP_NAME') ?: 'cybersec');

define('BASE_URL', getenv('BASE_URL') ?: 'http://localhost/cybersec/public');

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'cybersec');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');

define('UPLOAD_PATH', __DIR__ . '/../public/assets/uploads/profiles/');

date_default_timezone_set('America/Sao_Paulo');
