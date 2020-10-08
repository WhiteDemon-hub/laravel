<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Post;
use App\User;
use App\Like;
use App\Comment;
use App\Comments_like;
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
            $post->content = $request->content;
            $post->likes = '0';
        
            $post->save();

            $newpost = Post::where('id', '=',$post->id)->with('users')->get();
            $newpost[0]->is_like = '0';
            $newpost[0]->comments = [];
            return response() -> json([
                'post' => $newpost[0]
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
            if($request->is_like==0)
            {
                $like = new Like;
                $like->user_id = Session::get('id');
                $like->post_id = $post->id;
                $like->save();
                $post->likes = intval($post->likes)+1;
                $post->save();
                return null;
            }
            else
            {
                Like::where([['user_id', Session::get('id')], ['post_id',  $post->id]])->delete();
                $post->likes = intval($post->likes)-1;
                $post->save();
            }
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

            $posts = Post::where([['user_id', '=',$request->id], ['del', '0']])->with('users')->orderBy('id', 'DESC')->get();
            
            foreach($posts as $post)
            {
                $comments = Comment::wherePostId($post->id)->where('del', '0')->with('users')->orderBy('id')->get();
                if(Session::has('id'))
                {
                    foreach($comments as $comment)
                    {
                        $is_like = Comments_like::where([['user_id', Session::get('id')], ['comment_id', $comment->id]]) -> count();
                        $comment->is_like = $is_like;
                    }
                    $is_like = Like::where([['user_id', Session::get('id')], ['post_id', $post->id]])-> count();
                    $post->is_like = $is_like;
                }
                $post->comments = $comments; 
            }
            return response() -> json([
                'post' => $posts, 200
            ]);
    }

    public function getNews()
    {

            //$posts = Post::where([['user_id', '=', ['29', '30']]], ['del', '0']])->with('users')->orderBy('id', 'DESC')->get();
            $friendLeft = DB::table('friend_lists')
                ->select('*')
                ->where([['friend_lists.user_id_from', '=', Session::get('id')],
                ['friend_lists.status', '=', '1']])
                ->join('users', 'users.id', '=', 'friend_lists.user_id_to')
                ->join('posts', 'users.id', '=', 'posts.user_id')
                ->select('users.id as user_id', 'posts.id as id', 'posts.content as content', 'posts.del', 'posts.likes', 'posts.created_at')
                ->where('del', '0');
            $friendRight = DB::table('friend_lists')
                ->select('*')
                ->where([['friend_lists.user_id_to', '=', Session::get('id')],
                ['friend_lists.status', '=', '1']])
                ->join('users', 'users.id', '=', 'friend_lists.user_id_from')
                ->join('posts', 'users.id', '=', 'posts.user_id')
                ->select('users.id as user_id', 'posts.id as id', 'posts.content as content', 'posts.del', 'posts.likes', 'posts.created_at')
                ->where('del', '0');
            $posts = $friendLeft->union($friendRight)->orderBy('id', 'DESC')->get();
            // $posts_all = DB::table('posts');
            // $posts = $posts_all
            //     ->join($FL, $FL->id, '=', $posts_all->id)
            //     ->select("*");
                // return $posts_all->get();
                
            
            foreach($posts as $post)
            {
                $comments = Comment::wherePostId($post->id)->where('del', '0')->with('users')->orderBy('id')->get();
                $user = User::where('id', $post->user_id)->first();
                if(Session::has('id'))
                {
                    foreach($comments as $comment)
                    {
                        $is_like = Comments_like::where([['user_id', Session::get('id')], ['comment_id', $comment->id]]) -> count();
                        $comment->is_like = $is_like;
                    }
                    $is_like = Like::where([['user_id', Session::get('id')], ['post_id', $post->id]])-> count();
                    $post->is_like = $is_like;
                }
                $post->comments = $comments; 
                $post->users = $user;
            }
            //dd($posts);
            return response() -> json([
                'post' => $posts, 200
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

    public function postReestablish(Request $request)
    {
        if(Session::has('id'))
        {
            $post = Post::where([['id', '=', $request->id], ['user_id', Session::get('id')]])->first();
            $post->del='0';
            $post->save();
            return response() -> json([
                'id' => $post->id,
                'del' => $post->del
            ]);
        }
        return null;
    }

    public function destroy($id)
    {
        if(Session::has('id'))
        {
            $post = Post::where([['id', '=', $id], ['user_id', Session::get('id')]])->first();
            $post->del='1';
            $post->save();
            return response() -> json([
                'id' => $post->id,
                'del' => $post->del
            ]);
        }
        return null;
    }
}
