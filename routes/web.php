<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Article;

Route::get('/', function () {
    return view('react');
});

Route::get('/qwe', function () {
    return response()->myRes("hello");
})->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'admin', 'middleware'=>['web', 'auth']],function (){

    Route::get('/', ['uses'=>'Admin\AdminController@show', 'as'=>'admin_index']);
});
