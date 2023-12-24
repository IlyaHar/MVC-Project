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

}