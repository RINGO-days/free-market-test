<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;

Route::get('/',[ProductController::class,'index'])->middleware(['auth', 'verified']);
Route::get('show/{id}',[ProductController::class,'show']);
Route::get('search',[ProductController::class,'search']);
Route::post('like/{id}',[ProductController::class,'addLike']);
Route::post('comment/{id}',[ProductController::class,'addComment']);
Route::get('sell',[ProductController::class,'sell']);
Route::post('listing',[ProductController::class,'listing']);

Route::get('/purchase/newAddress/{id}', [PurchaseController::class, 'newAddress']);
Route::post('/purchase/sessionAddress/{id}', [PurchaseController::class, 'sessionAddress']);
Route::get('purchase/{id}',[PurchaseController::class,'purchase']);
Route::post('checkout/{id}',[PurchaseController::class,'checkout']);
Route::post('/purchase/cancel/{id}',[PurchaseController::class,'checkout']);
Route::get('/purchase/success/{id}', [PurchaseController::class, 'success']);


Route::get('/myList',[ProfileController::class,'myList']);
Route::get('/myList/editProfile',[ProfileController::class,'editProfile']);
Route::post('/myList/updateProfile',[ProfileController::class,'updateProfile']);
Route::get('/profile',[ProfileController::class,'profile']);
Route::post('/profile/create/',[ProfileController::class,'profileCreate']);
