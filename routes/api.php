<?php

\core\Router::add('api/auth/registration', [
    'controller' => \app\controllers\api\AuthController::class,
    'action' => 'signUp',
    'method' => 'POST'
]);

\core\Router::add('api/auth/login', [
    'controller' => \app\controllers\api\AuthController::class,
    'action' => 'signIn',
    'method' => 'POST'
]);