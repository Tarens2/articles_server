<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser($user_id, \Response $response)
    {

        return response()->json(compact(User::find($response['ids'])));
    }

    public function userArticles($user_id)
    {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];

        if ($user) {
            return response()->json(User::find($user_id)->articles);
//            return response()->json(User::find($user_id)->articles());
        } else {
            return $response;
        }
    }
}
