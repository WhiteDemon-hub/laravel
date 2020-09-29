<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Маршруты users
Route::resource('user', 'UserController');
Route::get('quit', 'UserController@getQuit');
Route::resource('user-register', 'UserController@postRegister');


//Маршруты сообщении
Route::resource('message', 'MessagesController');

//Маршруты постов
Route::resource('post', 'PostController');
Route::post('post-like', 'PostController@postLike');

//Маршруты комментариев
Route::resource('comment', 'CommentController');
Route::post('comment-like', 'CommentController@postLike');

//Маршруты френд листа
Route::resource('friendlist', 'FriendListController');
Route::get('friend-user', 'FriendListController@getUserFriend');
Route::get('friend-this-user', 'FriendListController@getFriend');