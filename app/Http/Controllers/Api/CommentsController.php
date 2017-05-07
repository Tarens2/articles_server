<?php

namespace App\Http\Controllers\Api;

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

        $comment = new Comment([
            'text' => $request->text,
            'article_id' => $article_id,
            'user_id' => $user->id
        ]);
        $comment->save();
        return response()->json($comment, 200);
    }
}
