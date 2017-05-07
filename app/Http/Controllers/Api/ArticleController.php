<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Article;

use JWTAuth;
use Response;
use App\Http\Controllers\Api\AuthController;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class ArticleController extends Controller
{


    public function getAllArticles()
    {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];
        if ($user) {
            return response()->json(Article::all());
        } else {
            return $response;
        }
    }

    public function getUserArticles()
    {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];

        if ($user) {
            return response()->json($user->articles);
        } else {
            return $response;
        }

    }

    public function postArticles(Request $request)
    {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];
        //dump($request);
        if ($user) {
            $article = new Article;
            $article->title = $request->get('title');
            $article->text = $request->get('text');
            $article->user_id = $user->id;
            $article->save();
            return response($article, 200);
        } else {
            return $response;
        }
    }
}
