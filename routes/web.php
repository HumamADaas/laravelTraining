<?php

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/sendEmail', function () {
    Mail::to('homam@gmail.com')->send(new TestMail());
    return 'sending';
});
