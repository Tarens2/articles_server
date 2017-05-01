<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Article;

use Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
class ArticleController extends Controller
{
    private function checkAuth() {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        return $user;
    }

    public function getAllArticles($user_id)
    {
        $user = $this->checkAuth();
//        return response()->json(Article::where('user_id', '=', $user_id)->get());
        return response()->json($user->articles);
    }

    public function postArticles(Request $request)
    {
        $user = $this->checkAuth();

        $article = new Article;
        $article->title = $request->get('title');
        $article->text = $request->get('text');
        $article->user_id = $user->id;
        $article->save();
        return response($article, 200);
    }
}
