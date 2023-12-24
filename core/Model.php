<?php

namespace core;

use core\traits\Queryable;

abstract class Model
{
    use Queryable;

    public int $id;
}