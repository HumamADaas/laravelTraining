<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Notifications\LoginNotification;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>['required','email'],
            'password'=>['required'],
            'c_password'=>['required','same:password']
    ]);
        if($validator->fails()) {
            return $this->sendError('validation error',$validator->errors());
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $access = $user->createToken('myApp');
        $success['token'] = $access->accessToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success,'User register successfully');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $user->tokens()->delete();

            $success['token'] = $user->createToken('myApp')->accessToken;
//            return $user->createToken('tokenCreated')->token->user_id;
            $success['name'] = $user->name;

//I will send notification to user after register , I put the logic in observer\UserObserver
//            Notification::send($user,new LoginNotification());

//            Notification::send($user,new LoginNotification());//this send email after login
            return $this->sendResponse($success,'user login');
        }
        return $this->sendResponse('unAuth',['error'=>'unAuth']);
    }
}
