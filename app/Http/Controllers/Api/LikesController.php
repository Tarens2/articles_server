<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikesController extends Controller
{
    //
    public function setLike($likeable_id) {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];

        if($user) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->likeable_id = $likeable_id;
            $like->likeable_type = Article::class;
            $like->save();

            return response()->json($like);
        }
        else {
            return $response;
        }
    }
}
