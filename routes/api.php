<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\Auth\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('register',[RegisterController::class,'register']);
Route::post('login',[RegisterController::class,'login']);

Route::middleware('auth:api')->group(function(){
    Route::resource('products',ProductController::class);
});
