<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Http\Request;
use Storage;
use DB;

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
        return redirect('/');
    }

    public function getfindUser(Request $request)
    {
        // return response() -> json([
        //     'find_result' => User::where('name', 'like', "%".$request->findText."%")
        //     ->orWhere('Surname', 'like', "%".$request->findText."%")
        //     ->orWhere('Middlename', 'like', "%".$request->findText."%")
        //     ->orWhere('concat(name, " ", Surname, " ", Middlename)', 'like', "%".$request->findText."%")
        //     ->select('id', 'name', 'Surname', 'Middlename', 'Photo')
        //     ->get()
        // ]);
        // dd(DB::select("SELECT id, `name`, Surname, Middlename, Photo
        // FROM users WHERE `name` LIKE '%$request->findText%' 
        // OR Surname LIKE '%$request->findText%' 
        // OR Middlename LIKE '%$request->findText%'
        // OR concat(name, ' ', Surname, ' ', Middlename) LIKE '%$request->findText%'
        // OR concat(Surname, ' ', name, ' ', Middlename) LIKE '%$request->findText%'"));
        return response() -> json([
            'find_result' => DB::select("SELECT id, `name`, Surname, Middlename, Photo
            FROM users WHERE `name` LIKE '%$request->findText%' 
            OR Surname LIKE '%$request->findText%' 
            OR Middlename LIKE '%$request->findText%'
            OR concat(name, ' ', Surname, ' ', Middlename) LIKE '%$request->findText%'
            OR concat(Surname, ' ', name) LIKE '%$request->findText%'"),
            'text' => $request->findText
        ]);
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
                'user' => $user, 200
            ]);
        }
        else
            return "Пользователь с таким email уже зарегестрирован";

    }

    public function postRegister(Request $request)
    {
        if(User::where('email', $_POST['email'])->count() == 0)
        {
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $path="noooo";
                $user = new User;
                $user->name = $_POST['name'];
                $user->Surname = $_POST['Surname'];
                $user->Middlename = $_POST['middenaem'];
                // if($_FILES['Photo']['tmp_name'] == UPLOAD_ERR_OR)
                // $path = "yess";
                if(isset($_FILES['image']["tmp_name"]))
                {
                    // $_FILES['image']->move(storage_path('images'), time().'_'.$_FILES['image']["tmp_name"]->getClientOriginalName());
                    // $path = $request->file('avatar')->$_FILES['image']["tmp_name"];
                    //move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."//img//".$_FILES['image']['name']);
                }
                // $file = $request->file('Photo');
                // $path = $request->file('Photo')->store('img', 'public');

                $path = $request->file('image')->store('img', 'public');
                $user->Photo = $path;
                $user->email = $_POST['email'];
                $user->password = md5($_POST['password']);
                $user->save();
                Session::put('id', $user->id);
                return redirect('/');
            }
            else
                return response() ->  json(['message' => "Некорректный email"]);
        }
        else
            return response() ->  json(['message' => "Пользователь с таким email уже зарегестрирован"]);
    }

    public function postAuth(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user != null)
        {
        if($user->password == md5($request->password))
        {
            Session::put('id', $user->id);
            // return response() -> json([
            //     'user' => $user, 200
            // ]);
            return response() ->  json(['message' => '1']);
            // return redirect("/");
        }
        else
        {
            return response() ->  json(['message' => "Неверный email или пароль"]);
            // return response() ->  json(['message' => $user->email]);
        }
        }
        else
        {
            return response() ->  json(['message' => "Неверный email или пароль"]);
        }
    }

    public function postUserFromPostOrComment(Request $request)
    {
        return response() -> json([
            'user' => User::where('id', '1')->first(), 200
        ]);
    }

    public function getSessionId()
    {
        if(Session::has('id'))
            return Session::get('id');
        else
            return 0;
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
        $user->id = $request->id;
        $user->name = $request->name;
        $user->Surname = $request->Surname;
        $user->Middlename = $request->Middlename;
        $user->Photo = $request->Photo;
        $user->email = $request->email;
        $user->password = md5($request->password);

        $user->save();
        return response() -> json([
            'user' => $user, 200
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
