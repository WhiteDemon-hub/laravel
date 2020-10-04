<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;

class AdminNavigateController extends Controller
{
    public function index()
    {
        if(Session::has('admin_id'))
        {
            return view('admin_panel');
        }
        else
        {
            return redirect('/');
        }
    }
}
