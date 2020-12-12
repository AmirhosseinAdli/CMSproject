<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostPrimController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::resource('posts', PostController::class);

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sendcode/{mobile}',[MobileController::class,'sendVerificationCode']);
Route::get('/verifycode/{mobile}/{code}',[MobileController::class,'verifyMobile']);

Route::get('request',function (){
    return view('services');
});

Route::group([
    'middleware' => 'auth'
],function (){
    Route::resource('posts', PostController::class);
//    Route::get('/all',[PostPrimController::class,'index'])->name('index');
//    Route::get('show',[PostPrimController::class,'show']);
});

