<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostPrimController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth',
    'as' => 'admin.',
],function (){
    Route::get('home',function (){
        return view('layouts.admin');
    })->name('home');

    Route::resource('users',AdminUserController::class);
  Route::get('users/{user}/activation',[AdminUserController::class,'activation'])->name('users.activation');

    Route::resource('posts',AdminPostController::class);
    Route::get('posts/{post}/activation',[AdminPostController::class,'activation'])->name('posts.activation');
});
