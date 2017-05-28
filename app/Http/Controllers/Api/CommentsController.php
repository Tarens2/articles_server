<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Comment;
use App\Http\Controllers\Controller;
use DB;
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
            $comment->save();
            Article::find($article_id)->increment('comments_count');

            return response()->json(DB::table('comments')
                ->where('article_id', $article_id)
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.*', 'users.login')
                ->get(), 200);
        } else {
            return $response;
        }
    }

    public function getComments($article_id)
    {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];


        if($user) {
            $comments = DB::table('comments')
                ->where('article_id', $article_id)
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.*', 'users.login')
                ->get();
            return response()->json($comments, 200);
        } else {
            return $response;
        }
    }
}
