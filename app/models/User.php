<?php

namespace app\models;

use core\Model;

class User extends Model
{
    protected static string|null $tableName = 'users';

    public string | null $email, $password, $token, $created_at,  $token_expired_at = null;

    public function getUserInfo(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'token' => $this->token,
            'created_at' => $this->created_at,
            'token_expired_at' => $this->token_expired_at
        ];
    }
}
