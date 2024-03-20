<?php

namespace App\Http\Controllers\Queue;

use App\Http\Controllers\Controller;
use App\Jobs\ActiveUsers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        ActiveUsers::dispatch(); //->delay(now()->second(40))
        
        return 'status updated...';

    }
}
