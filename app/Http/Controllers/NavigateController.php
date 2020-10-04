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
            return redirect('/profile/{'.Session::get('id').'}');
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
            return view('auth');
    }

    public function show($id)
    {
        return view('/profile', compact(User::find($id)));
    }
}
