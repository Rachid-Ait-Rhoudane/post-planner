<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class AuthWithGoogleController extends Controller
{

    public function create() {

        return Socialite::driver('google')->redirect();
    }

    public function store(Request $request) {

        $user = Socialite::driver('google')->user();

        Log::alert($user->token);
        Log::alert($user->email);
    }

}
