<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', 'PostController')->only([
    'index', 'show'
]);
Route::resource('comments', 'CommentController')->only([
    'index', 'show'
]);




