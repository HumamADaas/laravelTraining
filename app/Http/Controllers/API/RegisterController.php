<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function login(Request $request):JsonResponse
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('myApp')->accessToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success,'user login');
        }
        return $this->sendResponse('unAuth',['error'=>'unAuth']);
    }
}
