<?php

namespace App\Http\Controllers;
use DB;
use Session;
use App\User;
use App\Friend_list;
use Illuminate\Http\Request;

class FriendListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response() ->json([
            'friendlist' => Friend_list::latest()->get()
        ]);
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFriend()
    {
        if(Session::has('id'))
        {
            $friendLeft = DB::table('friend_lists')
                ->select('friend_lists.*')
                ->where([['friend_lists.user_id_from', '=', Session::get('id')],
                ['friend_lists.status', '=', '1']])
                ->join('users', 'users.id', '=', 'friend_lists.user_id_to')
                ->get();
            $friendRight = DB::table('friend_lists')
                ->select('friend_lists.*')
                ->where([['friend_lists.user_id_to', '=', Session::get('id')],
                ['friend_lists.status', '=', '1']])
                ->join('users', 'users.id', '=', 'friend_lists.user_id_from')
                ->get();
            $FL = $friendLeft->merge($friendRight);
        
            return response() -> json([
                'ThisUserFriend' => $FL,
            ]);
        }
        else
            return null;
    }

    public function getUserFriend(Request $request)
    {
            $friendLeft = DB::table('friend_lists')
                ->select('friend_lists.*')
                ->where([['friend_lists.user_id_from', '=', $request->id],
                ['friend_lists.status', '=', '1']])
                ->join('users', 'users.id', '=', 'friend_lists.user_id_to')
                ->get();
            $friendRight = DB::table('friend_lists')
                ->select('friend_lists.*')
                ->where([['friend_lists.user_id_to', '=', $request->id],
                ['friend_lists.status', '=', '1']])
                ->join('users', 'users.id', '=', 'friend_lists.user_id_from')
                ->get();
            $FL = $friendLeft->merge($friendRight);
        
            return response() -> json([
                'UserFriend' => $FL,
            ]);
    }

    public function getResponseFriend()
    {
        if(Session::has('id'))
        {
            $FL = DB::table('friend_lists')
                ->select('friend_lists.*')
                ->where([['friend_lists.user_id_to', '=', Session::get('id')],
                ['friend_lists.status', '=', '0']])
                ->join('users', 'users.id', '=', 'friend_lists.user_id_from')
                ->get();

            return response() -> json([
                'ResponseFriend' => $FL,
            ]);
        }
        else
            return null;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Session::get('id') &&
         Friend_list::where([['user_id_from', Session::get('id')], ['user_id_to', $request->id]])->count() <= 0)
        {
            $record = new Friend_list;
            $record->user_id_from = Session::get('id');
            $record->user_id_to = $request->id;
            $record->status = '0';
            $record->save();
            return true;
        }
        else    
            return false;
    }

    public function postFriendInfo(Request $request)
    {
        if(Session::get('id'))
        {
            if(Friend_list::where([['user_id_from', Session::get('id')], ['user_id_to', $request->id]])->count() === 0 &&
            Friend_list::where([['user_id_from', $request->id], ['user_id_to', Session::get('id')]])->count() === 0 )
            {
                 return 2;
            }
            else if(Friend_list::where([['user_id_from', Session::get('id')], ['user_id_to', $request->id], ['status', '0']])->count() == 1 ||
            Friend_list::where([['user_id_from', $request->id], ['user_id_to', Session::get('id')], ['status', '0']])->count() == 1)
            {
                return 0;
            }
            else if(Friend_list::where([['user_id_from', Session::get('id')], ['user_id_to', $request->id], ['status', '1']])->count() == 1 ||
            Friend_list::where([['user_id_from', $request->id], ['user_id_to', Session::get('id')], ['status', '1']])->count()  == 1)
            {
                return 1;
            }
        }
        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Friend_list  $friend_list
     * @return \Illuminate\Http\Response
     */
    public function show(Friend_list $friend_list)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Friend_list  $friend_list
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend_list $friend_list)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Friend_list  $friend_list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend_list $friend_list)
    {
        $friend_list = $request;
        $friend_list->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Friend_list  $friend_list
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Friend_list::where([['user_id_from', Session::get('id')], ['user_id_to', $id]])->delete();
        Friend_list::where([['user_id_from', $id], ['user_id_to', Session::get('id')]])->delete();
    }
}
