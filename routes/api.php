<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//login with notification to mailtrap
Route::post('register',[RegisterController::class,'register']);
Route::post('login',[RegisterController::class,'login']);


//passport
// create different token every time user does login that because refresh token in logout
Route::controller(UserController::class)->group(function(){
    Route::post('PassportLogin','loginUser');
});
Route::controller(UserController::class)->prefix('passport')->group(function(){
    Route::get('user','getUserDetail');
    Route::get('logout','userLogout');
})->middleware('auth:api');
