<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/',[UserController::class,'index']);
Route::get('email',[UserController::class,'email']); //後で消す
Route::get('profile',[UserController::class,'profile']); //後で消す
