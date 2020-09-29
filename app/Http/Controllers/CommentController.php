<?php

namespace App\Http\Controllers;

use Session;
use App\Comments_like;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Session::put('test', 'test');
        // return Session::get('test');
        return response() -> json([
            'comments' => Comment::latest()->get()
        ]);
    }

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
        if(Session::has('id'))
        {
            $comment = new Comment;
            $comment->post_id = $request->post_id;
            $comment->post_id = $request->post_id;
            $comment->post_id = $request->post_id;
            $comment->post_id = '0';
            $comment->save();
        }
        else
        return null;
    }

    public function postLike(Request $request)
    {
        if(Session::has('id'))
        {
            $comment = Comment::where('id', $request->comment_id)->get()[0];
            $like = new Comments_like;
            $like->user_id = Session::get('id');
            $like->comment_id = $comment->id;
            $like->save();
            $comment->likes = intval($comment->likes)+1;
            $comment->save();
            return response() -> json([
                'comment' => $comment
            ]);
        }
        else
            return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
    }
}