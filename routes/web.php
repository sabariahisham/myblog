<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

DB::listen(function ($event) {
    dump($event->sql);
}); //listenquery


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
