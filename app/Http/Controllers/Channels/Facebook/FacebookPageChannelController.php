<?php

namespace App\Http\Controllers\Channels\Facebook;

use App\Services\Facebook;
use App\Models\FacebookPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class FacebookPageChannelController extends Controller
{

    protected $facebook;

    public function __construct(Facebook $facebook) {

        $this->facebook = $facebook;
    }

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

            return redirect()->route('channels')->dangerBanner('Connecting your Facebook pages faild');
        }

        $request->user()->update([
            'facebook_user_token' => $facebookUser->token
        ]);

        $pages =  $this->facebook->pages($request->user()->facebook_user_token);

        if(! $pages) {
            return redirect()->route('channels')->dangerBanner('Connecting your Facebook pages faild');
        }

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

        return redirect()->route('channels')->banner('Channel connected successfully');
    }

    public function update(Request $request) {

        $page =  $this->facebook->refreshPageConnection($request->user()->facebook_user_token, $request->input('page_id'));

        if(! $page) {

            return redirect()->route('channels')->dangerBanner('Refreshing your Facebook page connection faild');
        }

        FacebookPage::where('page_id', $request->input('page_id'))
                    ->update([
                        'page_id' => $page['id'],
                        'page_name' => $page['name'],
                        'page_category' => $page['category'],
                        'page_profile_picture' => $page['picture']['data']['url'],
                        'page_access_token' => $page['access_token'],
                        'user_id' => $request->user()->id
                    ]);

        return redirect()->route('channels')->banner('Channel connection refreshed successfully');
    }

    public function destroy(Request $request) {

        FacebookPage::destroy($request->input('id'));

        return redirect()->route('channels')->banner('Channel disconnected successfully');
    }
}
