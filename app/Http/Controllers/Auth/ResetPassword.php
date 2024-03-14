<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\resetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;


class ResetPassword extends Controller
{
    public function resetPass(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!is_null($user) && !empty($user)) {

            $user->tokens()->delete();
            $token = $user->createToken('myApp')->accessToken;

            $user->notify(new resetPasswordNotification($token, $user));

            return redirect()->back()->with('message', 'check your email.');
        }
        return redirect()->back()->with('message', 'not found.');

    }

    public function viewReset()
    {
        return view('Auth.resetPassword');
    }

    public function viewNewPassword($token)
    {
        return view('Auth.newPassword', ['token' => $token]);
    }


    public function putNewPassword(Request $request, $token)
    {
        if (empty($token)) {
            // Handle the case when the token is missing
            return redirect()->route('getLogin')->with('message', 'Invalid token.');
        }
        $payload = explode('.', $token)[1];
        // Decoding the payload from base64
        $decodedPayload = base64_decode($payload);

        // Converting the JSON payload to an associative array
        $tokenData = json_decode($decodedPayload, true);
        $user = User::where('id', $tokenData['sub'])->first();
        if (!$user) {
            // Handle the case when the user is not found
            return redirect()->route('getLogin')->with('message', 'User not found.');
        }

        $newPassword = $request->input('newPassword');

        $user->password = Hash::make($newPassword);
        $user->save();

        // Redirect to login page with success message
        return redirect()->route('getLogin')->with('message', 'Password updated successfully.');


//        return response()->json([
//            'user' => $user,
//            'newPassword' => $newPassword // Adding new password to response for demonstration
//        ]);
    }

}
