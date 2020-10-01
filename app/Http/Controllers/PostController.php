<?php

namespace App\Http\Controllers;

use DB;
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
            $post = Post::where('id', $request->post_id)->first();
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

    // public function getFriendUserPost()
    // {
    //     $user_friend_post = Post::where()
    // }

    public function getUserPost(Request $request)
    {
        // $post_user = Post::where('id', '1')
        // ->with('comments')
        // ->
        // ->get();

        // $post_user = DB::table('posts')
        //     ->select('posts.*')

        // $post_user = DB::table('posts')
        //     ->select('posts.*')
        //     ->select('comments.*')
        //     ->join('comments', 'comments.post_id', '=', 'posts.id')
        //     ->where('posts.user_id', '=', '1')
            // ->get();

        // $post_user = DB::select(DB::raw("SELECT posts.*, CASE
        // WHEN (SELECT COUNT(id) FROM likes WHERE user_id = '1' AND posts.id = post_id) = 1
        // THEN 1
        // ELSE 0
        // END AS is_like
        // FROM posts WHERE user_id = 1"));

        // $comment = DB::select(DB::raw("SELECT comments.*, CASE
        // WHEN (SELECT COUNT(id) FROM comments_likes WHERE comments.id = comment_id) = 1
        // THEN 1
        // ELSE 0
        // END AS is_like
        // FROM comments"));

        // for($i = 0; $i < count($post_user);$i++)
        // {
        //     print_r($post_user[$i]);
        //     for($j = 0; $j < count($comment);$j++)
        //     {
        //         // if($post_user->id == $comment->post_id)
        //         // {
        //         //     $post_user[$i] = array($post_user[$i], $comment[$j]);
        //         // }
        //     }
        // }
        
        // return response() -> json([
        //     'post_user' => $post_user,
        //     'comments' => $comment
        // ]);

        // print_r($post_user->get());
        // echo '<br/>';
        // print_r($comment->get());
        $post_user;
        if(Session::has("id"))
        {
            $post_user = DB::select(DB::raw("SELECT posts.*, CASE
            WHEN (SELECT COUNT(id) FROM likes WHERE user_id = '1' AND posts.id = ".Session::get('id').") = 1
            THEN 1
            ELSE 0
            END AS is_like
            FROM posts WHERE user_id = ".$request->id));
        }
        else
        {
            $post_user = Post::where('user_id', $request->id)->get();
        }
        return response() -> json([
            'post' => $post_user, 200
        ]);
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
