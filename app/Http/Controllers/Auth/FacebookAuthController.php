<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    //

    public function redirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback() {
        $user = Socialite::driver('facebook')->user();

        Log::alert($user->token);
    }
}
