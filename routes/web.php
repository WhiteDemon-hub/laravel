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
Route::post('user-register', 'UserController@postRegister');
Route::post('user-from-post-or-comment', 'UserController@postUserFromPostOrComment');
Route::post('user-auth', 'UserController@postAuth');


//Маршруты сообщении
Route::resource('message', 'MessagesController');
Route::post('history-message', 'MessagesController@postChatHistory');
Route::post('history-new-message', 'MessagesController@postNewMessage');

//Маршруты постов
Route::resource('post', 'PostController');
Route::post('post-like', 'PostController@postLike');
Route::get('post-user', 'PostController@getUserPost');

//Маршруты комментариев
Route::resource('comment', 'CommentController');
Route::post('comment-like', 'CommentController@postLike');
Route::get('comment-post', 'CommentController@getCommentofPost');

//Маршруты френд листа
Route::resource('friendlist', 'FriendListController');
Route::get('friend-user', 'FriendListController@getUserFriend');
Route::get('friend-this-user', 'FriendListController@getFriend');
Route::get('response-friend', 'FriendListController@getResponseFriend');