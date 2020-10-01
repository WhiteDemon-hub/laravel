<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response() -> json([
            'users' => User::latest()->get(), 200
        ]);
        // $user = User::where('id', '1')->get()[0];
        // $user->name = "WhiteDemon";
        // $user->save();
        // return response() -> json([
        //     'users' => User::where('id', '1')->get(), 200
        // ]); 
        // return User::where('id', '1') ->get()[0];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function getQuit()
    {
        Session::flush();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(User::where('email', $request->email)->count() == 0)
        {
            $user = new User;
            $user->name = $request->name;
            $user->Surname = $request->Surname;
            $user->Middlename = $request->Middlename;
            $user->Photo = $request->Photo;
            $user->email = $request->email;
            $user->password = md5($request->password);

            $user->save();
            return response() -> json([
                'user' => $user->get(), 200
            ]);
        }
        else
            return "Пользователь с таким email уже зарегестрирован";

    }

    public function postRegister(Request $request)
    {
        if(User::where('email', $request->email)->count() == 0)
        {
            $user = new User;
            $user->name = $request->name;
            $user->Surname = $request->Surname;
            $user->Middlename = $request->Middlename;
            $user->Photo = $request->Photo;
            $user->email = $request->email;
            $user->password = md5($request->password);

            $user->save();
            Session::put('id', $user->id);
            // return response() -> json([
            //     'user' => $user->get(), 200
            // ]);
            return view('profil', ['user' => $user]);
        }
        else
            return "Пользователь с таким email уже зарегестрирован";
    }

    public function postAuth(Request $request)
    {
        $user = User::where('email', $request->email)->get();
        if(md5($user[0]->password) == md5($request->password))
        {
            Session::put('id', $user[0]->id);
            // return response() -> json([
            //     'user' => $user, 200
            // ]);
            return view('profil', ['user' => $user]);
        }
    }

    public function postUserFromPostOrComment(Request $request)
    {
        return response() -> json([
            'user' => User::where('id', '1')->first(), 200
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return redirect('profile/{'+ $id +'}')
        return view('profile/{'.$id.'}', ['user' => User::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->Surname = $request->Surname;
        $user->Middlename = $request->Middlename;
        $user->Photo = $request->Photo;
        $user->email = $request->email;
        $user->password = md5($request->password);

        $user->save();
        return response() -> json([
            'user' => $user->get(), 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return 0;
    }
}
