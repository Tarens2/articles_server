<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
    static public function checkAuth()
    {
        $response = null;
        $user = null;
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                $response = response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            $response = response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            $response = response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            $response = response()->json(['token_absent'], $e->getStatusCode());

        }
        return ['user' => $user, 'error' => $response];
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('login', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }


    public function getAuthenticatedUser()
    {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];

        if ($user) {
            return response()->json(compact('user'));
        } else {
            return $response;
        }
    }

    public function register(Request $request) {
//        User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => $request->password
//        ]);
    }
}
