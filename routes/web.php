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

/* Route::get('/users/{user}/show', function (User $user) {
    return $user;
}); */

Route::get('posts',[PostController::class, 'index'])->name('posts.index');
Route::post('posts',[PostController::class, 'store'])->name('posts.store');
Route::get('posts/{post}/edit',[PostController::class, 'edit'])->name('posts.edit');
Route::put('posts/{post}',[PostController::class, 'update'])->name('posts.update');
Route::delete('posts',[PostController::class, 'destroy'])->name('posts.index');
