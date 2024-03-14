<?php

use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\ResetPassword;
use App\Mail\TestMail;
use App\Notifications\LoginNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

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
