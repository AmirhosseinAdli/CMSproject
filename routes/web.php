<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostPrimController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
})->name('welcome');

Route::group([
    'prefix' => 'auth',
    ],function (){
    Route::get('register',[AuthController::class,'showRegister'])->name('showRegister');
    Route::post('register',[AuthController::class,'register'])->name('register');

    Route::get('mobileLogin',[AuthController::class,'mobileLogin'])->name('mobileLogin');
    Route::post('validation',[AuthController::class,'validation'])->name('validation');
    Route::post('verifyCode',[AuthController::class,'verifyCode'])->name('verifyCode');
    Route::post('login',[AuthController::class,'login'])->name('login');

    Route::get('logout',[AuthController::class,'logout'])->name('logout');
}
);

Route::group([
    'middleware' => 'auth'
],function (){
    Route::resource('posts', PostController::class);
    Route::get('home', [PostController::class,'home'])->name('posts.home');

    Route::resource('tags', TagController::class);

    Route::resource('categories', CategoryController::class);
});

