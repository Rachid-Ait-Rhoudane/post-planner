<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthWithGoogleController extends Controller
{

    public function create() {

        return Socialite::driver('google')->redirect();
    }

    public function store(Request $request) {

        try {

            $googleUser = Socialite::driver('google')->user();

        } catch(Exception $e) {

            return redirect('/login')->with('error', 'Authentication with Google Failed');
        }

        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

}
