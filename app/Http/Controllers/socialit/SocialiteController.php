<?php

namespace App\Http\Controllers\socialit;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    //show page login
    public function login(){
        return view('socialite.login');
    }

    //google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    //google callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $accessToken = $user->token;
        $this->_RegisterOrLoginUser($user);
        return "login using github is successfully, the user data: " . json_encode($user) . ". Your token is: $accessToken";
    }

    //facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    //facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('google')->user();
    }

    //github login
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    //github callback
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        $accessToken = $user->token;
        $this->_RegisterOrLoginUser($user);
        return "login using github is successfully, the user data: " . json_encode($user) . ". Your token is: $accessToken";
    }

    protected function _RegisterOrLoginUser($data)
    {
        $user = User::where('email','=',$data->email)->first();
        if(!$user){
            $user = new User();
            // take the nickname if user login using github
            $user->name = $data->name ?? 'GitHub User'; // Set a default name if GitHub doesn't provide one
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();
        }
        Auth::login($user);
    }
}
