<?php

namespace App\Http\Controllers;

use App\Events\LoginEvent;
use App\Notifications\EventAndListener\EmailLogin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EventAndListener extends Controller
{
    public function getLogin()
    {
        return view('EventAndListener.login');
    }

    public function Postlogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Dispatch the LoginEvent with the User object
            //make the event for login event
//        event(new loginEvent($user));
            LoginEvent::dispatch($user);

            // Return a response indicating successful login
            return 'Login is done. An email will be sent to the user.';
        }
        // Return a response indicating login failure
        return 'Invalid email or password.';

    }
}
