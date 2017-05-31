<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikesController extends Controller
{
    public function setArticleLike($likeable_id) {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];

        if($user) {
            $existed_like =Like::where([
                'likeable_id' => $likeable_id,
                'likeable_type' => Article::class,
                'user_id' => $user->id
            ]);
            if($existed_like->count())
            {
                $existed_like->delete();
                Article::find($likeable_id)->decrement('likes_count');

            }
            else {
                $like = new Like();
                $like->user_id = $user->id;
                $like->likeable_id = $likeable_id;
                $like->likeable_type = Article::class;
                $like->save();
                Article::find($likeable_id)->increment('likes_count');

            }


            return response()->json(Article::all()->load('user', 'user')->load('comments', 'comments.user'));
        }
        else {
            return $response;
        }
    }

    public function setCommentLike($likeable_id) {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];

        if($user) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->likeable_id = $likeable_id;
            $like->likeable_type = Comment::class;
            $like->save();

            $comment = Comment::find($likeable_id);
            $comment->increment('likes_count');

            return response()->json(Article::find($comment->article->id)->comments);
        }
        else {
            return $response;
        }
    }
}
