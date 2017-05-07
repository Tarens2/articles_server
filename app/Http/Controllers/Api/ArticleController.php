<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Article;

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

        dump($user->articles->load('comments','comments'));

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
            $article->user()->save($user);
            $article->save();
            return response($article, 200);
        } else {
            return $response;
        }
    }
}
