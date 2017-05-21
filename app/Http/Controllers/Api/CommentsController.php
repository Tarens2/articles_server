<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function setComment(Request $request, $article_id)
    {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];


        if($user) {
            $comment = new Comment([
                'text' => $request->text,
                'article_id' => $article_id,
                'user_id' => $user->id
            ]);
            Article::find($article_id)->comments()->save($comment);
            return response()->json(Article::all()->load('user', 'user')->load('comments','comments.user'), 200);
        } else {
            return $response;
        }
    }
}
