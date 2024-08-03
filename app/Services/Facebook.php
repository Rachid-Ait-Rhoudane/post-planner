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

    public function posts($page_token, $page_id, $before, $next) {

        $response = Http::withToken($page_token)->get('https://graph.facebook.com/v20.0/' . $page_id . '/feed', [
            'fields' => 'likes,comments,shares,attachments,message,permalink_url,application,created_time',
            'limit' => 5,
            'before' => $before,
            'after' => $next
        ]);

        if(! $response->successful()) {

            return false;
        }

        return $response;
    }

    public function startUploadSession($facebook_user_token, $fileName, $fileLength, $fileType) {

        $response = Http::withToken($facebook_user_token)->post('https://graph.facebook.com/v20.0/2122862738113634/uploads', [
            'filename' => $fileName,
            'file_length' => $fileLength,
            'file_type' => $fileType
        ]);

        if(! $response->successful()) {

            return false;
        }

        return $response['id'];
    }

    public function startUpload($facebook_user_token, $sessionID, $fileOffset = 0, $file) {

        $response = Http::withHeaders([
            'file_offset' => $fileOffset,
            'Authorization' => 'OAuth ' . $facebook_user_token
        ])
        ->attach('file', fopen($file, 'r'))
        ->post('https://graph.facebook.com/v20.0/' . $sessionID);

        if(! $response->successful()) {

            return false;
        }

        return $response['h'];
    }

    public function publishVideo() {


    }
}
