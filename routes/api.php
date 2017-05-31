<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('jwt.auth');



Route::post('auth','Api\AuthController@authenticate');
Route::get('auth/me','Api\AuthController@getAuthenticatedUser');

Route::post('register', 'Api\AuthController@register');

Route::get('articles', 'Api\ArticleController@getAllArticles');
Route::get('articles/me', 'Api\ArticleController@getUserArticles');
Route::get('articles/{article_id}/watchers', 'Api\WatcherController@getWatchers');
Route::get('articles/{article_id}/comments', 'Api\CommentsController@getComments');

Route::post('articles/{article_id}/watch', 'Api\WatcherController@setWatcher');
Route::post('articles/{article_id}/comment', 'Api\CommentsController@setComment');
Route::post('articles/{article_id}/like', 'Api\LikesController@setArticleLike');
Route::post('article','Api\ArticleController@postArticles');


Route::post('comments/{comment_id}/like', 'Api\LikesController@setCommentLike');

Route::get('users/{user_id}', 'Api\UserController@getUser');
Route::get('users/{user_id}/articles', 'Api\UserController@userArticles');

