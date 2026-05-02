<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;


Route::middleware('auth','verified')->group(function(){
    Route::get('/profile',[ProfileController::class,'profile']);
    Route::post('/profile/create/',[ProfileController::class,'profileCreate']);

    Route::prefix('product')->group(function(){
        Route::post('like/{item_id}',[ProductController::class,'addLike']);
        Route::post('comment/{item_id}',[ProductController::class,'addComment']);
        Route::get('sell',[ProductController::class,'sell']);
        Route::post('listing',[ProductController::class,'listing']);
    });

    Route::prefix('purchase')->group(function(){
        Route::get('{item_id}',[PurchaseController::class,'purchase']);
        Route::get('newAddress/{item_id}', [PurchaseController::class, 'newAddress']); //住所変更ページビュー
        Route::post('sessionAddress/{item_id}', [PurchaseController::class, 'sessionAddress']); //住所変更を保持するアクション
        Route::post('checkout/{item_id}',[PurchaseController::class,'checkout']);
        Route::get('cancel/{item_id}',[PurchaseController::class,'cancel']);
        Route::get('success/{item_id}', [PurchaseController::class, 'success']);
        Route::get('payment/{item_id}', [PurchaseController::class, 'paymentUpdate']); //購入画面、支払い方法変更の更新アクション
    });

    Route::prefix('myList')->group(function(){
        Route::get('/',[ProfileController::class,'myList']);
        Route::get('editProfile',[ProfileController::class,'Profile']);
        Route::post('updateProfile',[ProfileController::class,'profileCreate']);
    });
});

Route::post('/stripe/webhook', [PurchaseController::class, 'handleWebhook']);
Route::get('/',[ProductController::class,'index']);
Route::get('show/{item_id}',[ProductController::class,'show']);















