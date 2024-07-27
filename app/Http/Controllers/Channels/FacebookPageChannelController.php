<?php

namespace App\Http\Controllers\Channels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class FacebookPageChannelController extends Controller
{

    public function create() {

        return Socialite::driver('facebook')
                        ->setScopes([
                            'pages_show_list',
                            'pages_read_engagement',
                            'pages_manage_metadata',
                            'pages_read_user_content',
                            'pages_manage_posts',
                            'pages_manage_engagement',
                            'publish_video'
                        ])
                        ->redirect();
    }

    public function store(Request $request) {

        try {

            $facebookUser = Socialite::driver('facebook')->user();

        } catch(Exception $e) {

            return redirect('/channels')->with('error', 'Connecting your Facebook pages faild');
        }

        $request->user()->update([
            'facebook_user_token' => $facebookUser->token
        ]);

        return redirect('/channels')->with('message', 'Channel connected successfully');
    }
}
