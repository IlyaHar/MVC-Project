<?php
use core\Router;
Router::add(
    'users/{id:\d+}/edit', [
        'controller' => \app\controllers\UsersController::class,
        'action' => 'edit',
        'method' => 'GET'
    ]
);