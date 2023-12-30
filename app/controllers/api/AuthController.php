<?php

namespace app\controllers\api;

use app\models\User;
use app\validators\users\AuthValidator;
use app\validators\users\RegisterValidator;
use core\Controller;
use ReallySimpleJWT\Token;

class AuthController extends Controller
{
    public function signUp(): array
    {
        $data = requestBody();
        $validator = new RegisterValidator();

        if ($validator->validate($data)) {
            $user = User::create([
                ...$data,
                'password' => password_hash($data['password'], PASSWORD_BCRYPT)

                ]);

            return $this->response(200, $user->toArray());
        }

        return $this->response(200, [], $validator->getErrors());
    }

    public function signIn(): array
    {
        $data = requestBody();
        $validator = new AuthValidator();


        if ($validator->validate($data)) {
            $user = User::findBy('email', $data['email']);
            if (password_verify($data['password'], $user->password)) {
                $expiration = time() + 3600;
                $token = Token::create($user->id, $user->password, $expiration, 'localhost');


                return $this->response(200, compact('token'));
            }
        }

        return $this->response(200, [], $validator->getErrors());
    }
}

