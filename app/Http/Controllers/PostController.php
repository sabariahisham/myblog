<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** coding test from Cikgu Kamal - eager loading*/
        /* $posts = Post::select('id','title','content','author')->with(['user'=>function($q){
            $q->select('id','name','email');
        },'comments'=>function($q){
            $q->select('post_id','content','user_id');
        },'comments.user'=>function($q){
            $q->select('id','name');
        }])->get(); */
       // }])->withCount('user.posts')->get();
        // return response()->json($posts);


        //lazy loading//
        $posts = Post::all(); //-select * from `posts`
        //eager loading//
        //$posts = Post::with('user','comments.user.comments')->get();
        //return response()->json($posts);

        //eager loading dlm eloquent//
        //-$posts = Post::with('user','comments.user')->get();
        //user:relationship dlm model Post.php
        //comments:relationship dlm model Post.php
        //.(refer to)user:relationship dlm model Comment.php

        //$posts = Post::with('user','comments.user.comments')->get();
        //user:relationship dlm model Post.php
        //comments:relationship dlm model Post.php
        //.(refer to)user:relationship dlm model Comment.php
        //.(refer to)comments:relationship dlm model User.php

        //$comments = '';

        // return view('posts.index', [
        //     'post' => $post,
        //     'comments' => $comments
        // ]);

        //return view('posts.index', compact('post', 'comments')); //cara ringkas
        //-return view('posts.index', compact('posts'));

        //$posts = Post::withCount('comments')->get();
        //return view('posts.comment', compact('posts'));

        //$posts = Post::whereHas('comments')->count(); //output 497
        //$posts = Post::whereDoesntHave('comments')->count(); //output 3
        $posts = Post::whereHas('comments', function($query){
            $query->where('user_id', 3);
        })->get(); //load record yg ada user_id=3
        //dd($posts);

        $posts = Post::with(['comments' => function($query) {
            $query->where('user_id', 3);
        }])->get(); //bawa semua termasuk null record

        $posts = Post::whereHas('comments',function($query){
            $query->where('user_id',3);
        })->with(['comments'=>function($query){
            $query->where('user_id',3);
        }])->get();
        //whereHas: select * from `posts` where exists (select * from `comments` where `posts`.`id` = `comments`.`post_id` and `user_id` = ?)
        //with: select * from `comments` where `comments`.`post_id` in (3, 4, 10, 12, 13, 31, 54, 69, 73, 78, 79, 97, 99, 128, 137, 161, 167, 173, 179, 212, 217, 219, 230, 235, 236, 243, 255, 269, 307, 311, 319, 324, 344, 366, 388, 392, 403, 418, 428, 437, 438, 440, 469, 474, 496) and `user_id` = ?

        return view('posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //


  }
}