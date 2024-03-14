<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\LoginNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class Register extends Controller
{
    public function loginShow(){
        return view('Auth.login');
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $user->tokens()->delete();

            $success['token'] = $user->createToken('myApp')->accessToken;
            $success['name'] = $user->name;


            Notification::send($user, new LoginNotification());//this send email after login
            return 'auth';
        }
        return 'unAuth';
    }
}

