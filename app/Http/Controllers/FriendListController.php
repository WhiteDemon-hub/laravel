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
        // return response() ->json([
        //     'friendlist'
        // ]);
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
                ->select('friend_lists.status')
                ->where([['friend_lists.user_id_from', '=', Session::get('id')],
                ['friend_lists.status', '=', '1']])
                ->join('users', 'users.id', '=', 'friend_lists.user_id_to')
                ->get();
            $friendRight = DB::table('friend_lists')
                ->select('friend_lists.status')
                ->where([['friend_lists.user_id_to', '=', Session::get('id')],
                ['friend_lists.status', '=', '1']])
                ->join('users', 'users.id', '=', 'friend_lists.user_id_from')
                ->get();
            $FL = $friendLeft->union($friendRight);
        
            return $FL;
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
        
            return $FL;
    }

    public function 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Friend_list  $friend_list
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend_list $friend_list)
    {
        $friend_list->delete();
    }
}
