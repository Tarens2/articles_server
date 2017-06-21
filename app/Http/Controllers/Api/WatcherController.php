<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Watcher;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class WatcherController extends Controller
{
    public function setWatcher($article_id)
    {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];


        if($user) {
            if(Watcher::all()->filter(function ($value, $key) use ($article_id, $user) {
                return $value->article_id == $article_id && $value->user_id == $user->id;
            })->count()){
                return response()->json("Secound view", 201);
            }

            $watcher = new Watcher([
                'article_id' => $article_id,
                'user_id' => $user->id
            ]);
            $watcher->save();
            return response()->json(["First view"], 200);
        } else {
            return $response;
        }
    }

    public function getWatchers($article_id) {
        $auth = AuthController::checkAuth();
        $response = $auth['error'];
        $user = $auth['user'];


        if($user) {
            return response()->json(Watcher::select('article_id', 'created_at')
                ->where('article_id', $article_id)
                ->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('Y:m:d');
                }));
        } else {
            return $response;
        }
    }
}
