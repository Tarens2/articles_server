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
Route::post('register', 'Api\AuthController@register');

Route::get('auth/me','Api\AuthController@getAuthenticatedUser');

Route::get('articles/me', 'Api\ArticleController@getUserArticles');
Route::get('articles', 'Api\ArticleController@getAllArticles');
Route::post('articles/{article_id}/watch', 'Api\WatcherController@setWatcher');
Route::get('articles/{article_id}/watchers', 'Api\WatcherController@getWatchers');
Route::get('articles/{article_id}/comments', 'Api\CommentsController@getComments');

Route::post('article','Api\ArticleController@postArticles');

Route::post('like/{likeable_id}', 'Api\LikesController@setLike');

Route::post('articles/{article_id}/comment', 'Api\CommentsController@setComment');
Route::post('articles/{article_id}/like', 'Api\LikesController@setLike');

Route::get('users/{user_id}', 'Api\UserController@getUser');
Route::get('users/{user_id}/articles', 'Api\UserController@userArticles');

