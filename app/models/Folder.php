<?php

namespace app\models;

use core\Model;

class Folder extends Model
{
    protected static string|null $tableName = 'folders';

    public string $title, $created_at, $updated_at;

    public int|null $user_id;

}