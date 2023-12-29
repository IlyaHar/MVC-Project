<?php


use app\models\User;

define('BASE_DIR', dirname(__DIR__));

require_once BASE_DIR . '/config/constants.php';
require_once BASE_DIR . '/vendor/autoload.php';

try {
    $dotenv = \Dotenv\Dotenv::createUnsafeImmutable(BASE_DIR);
    $dotenv->load();



    die(\core\Router::dispatch($_SERVER['REQUEST_URI']));

} catch (PDOException $exception) {
    dd('PDOException', $exception);
} catch (Exception $exception) {
    dd('Exception', $exception);
}