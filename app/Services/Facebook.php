<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class Facebook {

    public function pages($facebook_user_token) {

        $response = Http::withToken($facebook_user_token)->get('https://graph.facebook.com/v20.0/me/accounts', [
            'fields' => 'name,category,picture,access_token'
        ]);

        if(! $response->successful()) {

            return false;
        }

        return $response->collect()['data'];
    }

    public function refreshPageConnection($facebook_user_token, $page_id) {

        $response = Http::withToken($facebook_user_token)->get('https://graph.facebook.com/v20.0/' . $page_id, [
            'fields' => 'name,category,picture,access_token'
        ]);

        if(! $response->successful()) {

            return false;
        }

        return $response;
    }

    public function getPost($page_token, $page_id) {

        $response = Http::withToken($page_token)->get('https://graph.facebook.com/v20.0/' . $page_id . '/feed', [
            'fields' => 'likes,comments,shares,attachments,message,permalink_url'
        ]);

        if(! $response->successful()) {

            return false;
        }

        return $response;
    }
}
