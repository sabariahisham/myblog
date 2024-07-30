<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

//listenquery
// DB::listen(function ($event) {
//     dump($event->sql);
// });


Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{user}/show', function (User $user) {
    return $user;
});

Route::post('/users/{user}', function (User $user) {
    return $user;
});

Route::post('/users/{user}/edit', function (User $user) {
    return $user;
});


Route::get('posts',[PostController::class, 'index'])->name('posts.index');