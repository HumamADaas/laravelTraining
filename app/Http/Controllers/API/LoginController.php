<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\LoginNotification;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials))
        {
            $user = Auth::user();
            $user->tokens()->delete();

            $token = $user->createToken('MyApp')->accessToken;
            $user->notify(new LoginNotification());
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
