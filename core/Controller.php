<?php

namespace core;

abstract class Controller
{
    public function before(string $action, array $params = []): bool
    {
        return true;
    }

    public function after(string $action): void
    {

    }

    protected function response(int $code = 200, array $body = [], array $errors = []): array
    {
        return compact('code', 'body', 'errors');
    }

}