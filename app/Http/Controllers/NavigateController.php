<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;

class NavigateController extends Controller
{
    public function index()
    {
        if(Session::has('id'))
        {
            return redirect('/profile'.'/'.Session::get('id'));
        }
        else
        {
            return redirect('/auth');
        }

    }

    public function auth()
    {
        if(Session::has("id"))
            return redirect('/');
        else
            return view('/auth');
    }

    public function showFriendList()
    {
        if(Session::has("id"))
            return view('friendlist');
        else
            return redirect('auth');
    }

    public function showNews()
    {
        if(Session::has("id"))
            return view('news');
        else
            return redirect('auth');
    }

    public function show($id)
    {
        return view('/profile', ['user' => User::where('id', $id)->select('users.id', 'users.name', 'users.Surname', 'users.Photo', 'users.Middlename')->first()]);
    }
}
