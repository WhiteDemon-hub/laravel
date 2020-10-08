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

// Route::get('/', function () {
//     return view('welcome');
// });

//Маршруты users
Route::resource('user', 'UserController');
Route::get('quit', 'UserController@getQuit');
Route::post('user-register', 'UserController@postRegister');
Route::post('user-from-post-or-comment', 'UserController@postUserFromPostOrComment');
Route::post('user-auth', 'UserController@postAuth');
Route::get('user-session', 'UserController@getSessionId');
Route::get('user-find', 'UserController@getfindUser');


//Маршруты сообщении
Route::resource('message', 'MessagesController');
Route::post('history-message', 'MessagesController@postChatHistory');
Route::post('history-new-message', 'MessagesController@postNewMessage');

//Маршруты постовgetNews
Route::resource('post', 'PostController');
Route::post('post-like', 'PostController@postLike');
Route::get('post-user', 'PostController@getUserPost');
Route::get('news-user', 'PostController@getNews');
Route::post('post-del-cancel', 'PostController@postReestablish');

//Маршруты комментариев
Route::resource('comment', 'CommentController');
Route::post('comment-like', 'CommentController@postLike');
Route::get('comment-post', 'CommentController@getCommentofPost');
Route::post('comment-del-cancel', 'CommentController@postReestablish');

//Маршруты френд листа
Route::resource('friendlist', 'FriendListController');
Route::get('friend-user', 'FriendListController@getUserFriend');
Route::get('friend-this-user', 'FriendListController@getFriend');
Route::get('response-friend', 'FriendListController@getResponseFriend');
Route::post('info-friend', 'FriendListController@postFriendInfo');
Route::post('confirm-friend', 'FriendListController@postFriendConfirm');
//Маршруты админа
Route::resource('admin', 'AdminController');
Route::get('admin', 'AdminController@getQuit');

//Маршруты панели администратора
Route::get('admin_panel', 'AdminNavigateController@index');

//Навигация
Route::get("/", 'NavigateController@index');
Route::get("/auth", 'NavigateController@auth');
Route::get("/profile/{user}", 'NavigateController@show');
Route::get("/list", 'NavigateController@showFriendList');
Route::get("/news", 'NavigateController@showNews');

