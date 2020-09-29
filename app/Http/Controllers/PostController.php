<?php

namespace App\Http\Controllers;

use Session;
use App\Post;
use App\Like;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response() ->json([
            'post' => Post::latest()->get()
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
            $post = new Post;
            $post->user_id = Session::get('id');
            $post->content = $request;
            $post->likes = '0';
        
            $post->save();
            return response() -> json([
                'post' => $post->get()
            ]);
        }
        else
            return null;
    }

    public function postLike(Request $request)
    {
        if(Session::has('id'))
        {
            $post = Post::where('id', $request->post_id)->get()[0];
            $like = new Like;
            $like->user_id = Session::get('id');
            $like->post_id = $post->id;
            $like->save();
            $post->likes = intval($post->likes)+1;
            $post->save();
            return response() -> json([
                'post' => $post
            ]);
        }
        else
            return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return null;
    }
}
