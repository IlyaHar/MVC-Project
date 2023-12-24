<?php

use core\Config;
use core\Db;
function config(string $name): string | null
{
    return Config::get($name);
}

function db(): PDO
{
    return Db::connect();
}