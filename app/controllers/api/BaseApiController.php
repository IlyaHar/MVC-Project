<?php

namespace app\controllers\api;

use app\models\User;
use core\Controller;
use ReallySimpleJWT\Token;

class BaseApiController extends Controller
{
    public function before(string $action, array $params = []): bool
    {

        $requestToken = getToken();
        $user = User::find(authId());


        if (!Token::validate($requestToken, $user->password)) {
            throw new \Exception('Token is invalid', 422);
        }
        return true;


    }

}