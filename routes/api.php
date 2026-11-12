<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('/register',[AuthController::class,'store']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum','role:admin'])->group(function(){
      
});

Route::middleware(['auth:sanctum','role:user,admin'])->group(function(){

});

    Route::get('/category',[CategoryController::class,'index']);
    Route::post('/category',[CategoryController::class,'store']);
    Route::get('/category/{id}',[CategoryController::class,'show']);
    Route::put('/category/{id}',[CategoryController::class,'update']);
    Route::delete('/category/{id}',[CategoryController::class,'destroy']);

    Route::get('/product',[ProductController::class,'index']);
    Route::post('/product',[ProductController::class,'store']);
