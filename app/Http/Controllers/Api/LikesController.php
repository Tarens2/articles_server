<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
            $existed_like =Like::where([
                'likeable_id' => $likeable_id,
                'likeable_type' => Comment::class,
                'user_id' => $user->id
            ]);
            $comment = Comment::find($likeable_id);
            if($existed_like->count())
            {
                $existed_like->delete();
                $comment->decrement('likes_count');

            }
            else {
                $like = new Like();
                $like->user_id = $user->id;
                $like->likeable_id = $likeable_id;
                $like->likeable_type = Comment::class;
                $like->save();
                $comment->increment('likes_count');

            }
            return response()->json($comments = DB::table('comments')
                ->where('article_id', $comment->article->id)
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.*', 'users.login')
                ->get());
        }
        else {
            return $response;
        }
    }
}
