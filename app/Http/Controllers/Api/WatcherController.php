<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function setWatcher($user_id, $article_id)
    {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];


        if($user) {
            $watcher = new Watcher([
                'article_id' => $article_id,
                'user_id' => $user->id
            ]);
            Article::find($article_id)->watchers()->save($watcher);
            return response()->json(Article::all()->load('user', 'user')->load('comments','comments.user'), 200);
        } else {
            return $response;
        }
    }
}
