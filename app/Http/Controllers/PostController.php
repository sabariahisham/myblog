<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** coding test from Cikgu Kamal - eager loading*/
        $posts = Post::select('id','uuid','title','content','author')->with(['user'=>function($q){
            $q->select('id','name','email');
        },'comments'=>function($q){
            $q->select('post_id','content','user_id', 'uuid');
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

        $users = User::pluck('name','id');
        return view('posts.index', compact('posts','users'));
    }

    function ajaxloadpost(Request $request) {
        try {
            $post = Post::where('uuid',$request->uuid)->first();
        } catch (\Throwable $th) {
            abort(404);
        }

        return response()->json($post);
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
        $users = User::pluck('name','id'); //dd($users);
        $post = $post->load('user.posts', 'comments.user.posts'); //dlm eloquent ada with, dlm collection ada load
        return view('posts.show',compact('post','users'));
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
    //public function update(Request $request, Post $post) //laravel standard,
    public function update(Request $request)
    //public function update(CommentStoreRequest $request) bila guna dr request tp dlm controller perlu ada validate (rules+message)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'content' => 'required|min:10'
        ],[
            'title.required' => 'Sila masukkan tajuk',
            'author.required' => 'Sila pilih penulis',
            'content.required' => 'Sila masukkan kandungan',
            'content.min' => 'Kandungan mesti sekurang-kurangnya 10 aksara'
        ]);

        $post = Post::where('uuid',$request->uuid)->first();
        $post->title = $request->title;
        $post->author = $request->author;
        $post->content = $request->content;
        $post->save();

        return response()->json(['status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //


  }
}
