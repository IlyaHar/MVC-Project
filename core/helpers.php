<?php

use core\Config;
use core\Db;
function config(string $name): string | null
{
    return Config::get($name);
}

function db(string $name): PDO
{
    return Db::connect();
}