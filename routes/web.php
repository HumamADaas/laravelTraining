<?php

use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\ResetPassword;
use App\Http\Controllers\EventAndListener;
use App\Http\Controllers\QR\QRUsers;
use App\Http\Controllers\Queue\UserController;
use App\Http\Controllers\socialit\SocialiteController;
use App\Mail\TestMail;
use App\Notifications\LoginNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

//
//Route::get('/', function () {
//    return view('welcome');
//});
//trying to send email
Route::get('/sendEmail', function () {
    Mail::to('homam@gmail.com')->send(new TestMail());
    return 'sending';
});
Route::get('send', function () {
    Notification::send('homamDaa@gmail.com', new LoginNotification());
});


Route::get('login', [Register::class, 'loginShow'])->name('getLogin');
Route::post('login', [Register::class, 'login'])->name('postLogin');

Route::group(['prefix' => 'toResetPassword'], function () {

    //take email and send notification to reset
    Route::get('resetPass', [ResetPassword::class, 'viewReset'])->name('getResetPass');
    Route::post('resetPassword', [ResetPassword::class, 'resetPass'])->name('postResetPass');

    //what user sees in his email
    Route::get('buttonReset', function () {
        return view('Auth.buttonReset');
    })->name('buttonReset');

    //page contains field to reset password
    Route::get('FieldNewPassword/{token}', [ResetPassword::class, 'viewNewPassword'])->name('VNP');
    Route::post('FieldNewPass/{token}', [ResetPassword::class, 'putNewPassword'])->name('PNP');
});

//event and listener : send email after login
Route::group(['prefix' => 'eventAndListener'], function () {

    Route::get('pageLogin', [EventAndListener::class,'getLogin']);
    Route::post('pageLogin', [EventAndListener::class,'postLogin'])->name('loginEvent');
    Route::post('logout/{id}',[EventAndListener::class,'logout'])->name('logoutEvent');
});

Route::get('socialite',[SocialiteController::class,'login']);

//Google login
Route::get('login/google',[SocialiteController::class,'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback',[SocialiteController::class,'handleGoogleCallback']);

//Facebook login
Route::get('login/facebook',[SocialiteController::class,'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback',[SocialiteController::class,'handleFacebookCallback']);

//Github login
Route::get('login/github',[SocialiteController::class,'redirectToGithub'])->name('login.github');
Route::get('login/github/callback',[SocialiteController::class,'handleGithubCallback']);

//queue
Route::get('usersActive',[UserController::class,'index']);

//queue
Route::get('users',[QRUsers::class,'userEncryption']);
