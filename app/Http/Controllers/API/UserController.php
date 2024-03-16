<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        $input = $request->all();

        Auth::attempt($input);

        $user = Auth::user();

        $token = $user->createToken('example')->accessToken;
//        return response()->json("your token is . $token");
        return Response(['status' => 200,'token' => $token],200);
    }


    public function getUserDetail(): Response
    {
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            return Response(['data' => $user],200);
        }
        return Response(['data' => 'Unauthorized'],401);
    }


    public function userLogout(): Response
    {
        if(Auth::guard('api')->check()){
            $accessToken = Auth::guard('api')->user()->token();

            DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update(['revoked' => true]);
            $accessToken->revoke();

            return Response(['data' => 'Unauthorized','message' => 'User logout successfully.'],200);
        }
        return Response(['data' => 'Unauthorized'],401);
    }

}
