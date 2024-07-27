<?php

namespace App\Http\Controllers\Channels;

use App\Models\FacebookPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
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

        $response = Http::withToken($request->user()->facebook_user_token)->get('https://graph.facebook.com/v20.0/me/accounts', [
            'fields' => 'name,category,picture,access_token'
        ]);

        if(! $response->successful()) {

            return redirect('/channels')->with('error', 'Connecting your Facebook pages faild');
        }

        $pages = $response->collect()['data'];

        foreach($pages as $page) {

            FacebookPage::create([
                'page_id' => $page['id'],
                'page_name' => $page['name'],
                'page_category' => $page['category'],
                'page_profile_picture' => $page['picture']['data']['url'],
                'page_access_token' => $page['access_token'],
                'user_id' => $request->user()->id
            ]);
        }

        return redirect('/channels')->with('message', 'Channel connected successfully');
    }
}
