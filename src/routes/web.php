<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/',[ProductController::class,'index']);
Route::get('email',[UserController::class,'email']); //後で消す
Route::get('profile',[UserController::class,'profile']); //後で消す
Route::get('show/{id}',[ProductController::class,'show']);
Route::get('search',[ProductController::class,'search']);
Route::post('like/{id}',[ProductController::class,'addLike']);
Route::post('comment/{id}',[ProductController::class,'addComment']);
Route::get('buy/{id}',[ProductController::class,'buy']);
