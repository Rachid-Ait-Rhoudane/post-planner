<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class Facebook {

    public static function pages($facebook_user_token) {

        $response = Http::withToken($facebook_user_token)->get('https://graph.facebook.com/v20.0/me/accounts', [
            'fields' => 'name,category,picture,access_token'
        ]);

        if(! $response->successful()) {

            return false;
        }

        return $response->collect()['data'];
    }

    public static function refreshPageConnection($page_id) {

        $response = Http::withToken($request->user()->facebook_user_token)->get('https://graph.facebook.com/v20.0/' . $page_id, [
            'fields' => 'name,category,picture,access_token'
        ]);

        if(! $response->successful()) {

            return false;
        }

        return $response;
    }
}
