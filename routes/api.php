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

\core\Router::add('api/folders', [
    'controller' => \app\controllers\api\FoldersController::class,
    'action' => 'index',
    'method' => 'GET'
]);

\core\Router::add('api/folders/{id:\d+}', [
    'controller' => \app\controllers\api\FoldersController::class,
    'action' => 'show',
    'method' => 'GET'
]);

\core\Router::add('api/folders/store', [
    'controller' => \app\controllers\api\FoldersController::class,
    'action' => 'store',
    'method' => 'POST'
]);


\core\Router::add('api/folders/{id:\d+}/update', [
    'controller' => \app\controllers\api\FoldersController::class,
    'action' => 'update',
    'method' => 'PUT'
]);

\core\Router::add('api/folders/{id:\d+}/destroy', [
    'controller' => \app\controllers\api\FoldersController::class,
    'action' => 'destroy',
    'method' => 'DELETE'
]);