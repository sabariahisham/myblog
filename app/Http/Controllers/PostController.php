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
        $posts = Post::select('id','title','content','author')->with(['user'=>function($q){
            $q->select('id','name','email');
        },'comments'=>function($q){
            $q->select('post_id','content','user_id');
        },'comments.user'=>function($q){
            $q->select('id','name');
        }])->get();
        // return response()->json($posts);


        //lazy loading//
        //$posts = Post::all();
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
