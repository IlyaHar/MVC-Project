<?php
define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/config/constants.php';
require_once BASE_DIR . '/vendor/autoload.php';

try {
    $dotenv = \Dotenv\Dotenv::createUnsafeImmutable(BASE_DIR);
    $dotenv->load();

    if (!preg_match('/assets/i', $_SERVER['REQUEST_URI'])) {
        \core\Router::dispatch($_SERVER['REQUEST_URI']);
    }
} catch (PDOException $exception) {
    dd('PDOException', $exception);
} catch (Exception $exception) {
    dd('Exception', $exception);
}