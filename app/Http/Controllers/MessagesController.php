<?php

namespace App\Http\Controllers;

use Session;
use App\Messages;
use Illuminate\Http\Request;
use Crypt;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $text = encrypt("text");
        // return decrypt($text);
        return response() -> json([
            'messages' => Messages::latest()->get()
        ]);
        // $message_left = Messages::where([['user_id_from', '=', 1], ['user_id_to', '=', 4]]);
        //     $message_right = Messages::where([['user_id_from', '=', 4], ['user_id_to', '=', 1]]);
        //     $history = $message_left->union($message_right)->orderBy('id')->get();
        //     for($i = 0; $i < $history->count(); $i++)
        //     {
        //         $history[$i]->content = decrypt($history[$i]->content);
        //     }
        //     return response() -> json([
        //         'history' => $history,
        //     ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function postChatHistory(Request $request)
    {
        if(Session::has('id'))
        {
            $message_left = Messages::where([['user_id_from', '=', Session::get('id')], ['user_id_to', '=', $request->id]]);
            $message_right = Messages::where([['user_id_from', '=', $request->id], ['user_id_to', '=', Session::get('id')]]);
            $history = $message_left->union($message_right)->orderBy('id');
            for($i = 0; $i < $history->count(); $i++)
            {
                $history[$i]->content = decrypt($history[$i]->content);
            }
            return response() -> json([
                'history' => decrypt($history),
            ]); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    public function postNewMessage(Request $request)
    {
        if(Session::has('id'))
        {
            $message = new Messages;
            $message->user_id_from = Session::get('id');
            $message->user_id_to = $request->id;
            $message->content = encrypt($request->content);
            $message->save();
            return response() -> json([
                'message' => $message,
            ]);
        }
        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function show(Messages $messages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $messages)
    {
        //
    }
}
