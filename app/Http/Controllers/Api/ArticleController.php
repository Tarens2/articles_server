<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Article;

use Response;
use App\Http\Controllers\Api\AuthController;

class ArticleController extends Controller
{


    public function getAllArticles()
    {
        $user = AuthController::checkAuth();
        return response()->json($user->articles);
    }

    public function getUserArticles($user_id)
    {
        $user = AuthController::checkAuth();
        return response()->json(Article::where('user_id', '=', $user_id)->get());
    }

    public function postArticles(Request $request)
    {
        $user = AuthController::checkAuth();

        $article = new Article;
        $article->title = $request->get('title');
        $article->text = $request->get('text');
        $article->user_id = $user->id;
        $article->save();
        return response($article, 200);
    }
}
