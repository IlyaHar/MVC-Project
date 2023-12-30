<?php

namespace app\validators\users;

use app\models\User;
use app\validators\BaseValidator;

class Base extends BaseValidator
{
    public function checkEmailOnExists(string $email, bool $eq = true, string $message = 'Email already exists'): bool
    {
        $result = (bool)User::findBy('email', $email);

        if ($result === $eq) {
            $this->setError('email', $message);
        }

        return $result;
    }
}