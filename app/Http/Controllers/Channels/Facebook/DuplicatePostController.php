<?php

namespace App\Http\Controllers\Channels\Facebook;

use App\Services\Facebook;
use App\Models\FacebookPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DuplicatePostController extends Controller
{
    protected $facebook;

    public function __construct(Facebook $facebook) {

        $this->facebook = $facebook;
    }

    public function store(Request $request) {

        $post = FacebookPost::findOrFail($request->input('postID'));
        $page_id = $post->facebook_page->page_id;
        $page_access_token = $post->facebook_page->page_access_token;

        if($post->file_type) {

            $fileName = explode('/', $post->file_path)[1];
            $fileLength = Storage::disk('public')->size($post->file_path);
            $fileType = Storage::disk('public')->mimeType($post->file_path);

            $uploadSessionID = $this->facebook->startUploadSession($request->user()->facebook_user_token, $fileName, $fileLength, $fileType);

            $uploadFileHandle = $this->facebook->startUpload($request->user()->facebook_user_token, $uploadSessionID, 0, Storage::disk('public')->get($post->file_path), $fileName);

            if($post->file_type === 'image') {
                $photoPostID = $this->facebook->publishPhoto($page_access_token, $page_id, $post->title, $post->description, $uploadFileHandle);
                $postInfo = $this->facebook->postInfo($page_access_token, $photoPostID['post_id']);
                FacebookPost::create([
                    'post_id' => $photoPostID['post_id'],
                    'title' => $post->title,
                    'description' => $post->description,
                    'file_type' => 'image',
                    'file_path' => $post->file_path,
                    'facebook_page_id' => $post->facebook_page_id,
                    'original_link' => $postInfo['permalink_url']
                ]);
                return redirect()->route('publish', [
                    'pageID' => $post->facebook_page_id
                ])->banner('photo duplicated successfully');
            }

            if($post->file_type === 'video') {
                $videoPostID = $this->facebook->publishVideo($page_access_token, $page_id, $post->title, $post->description, $uploadFileHandle);
                $videoPostInfo = $this->facebook->videoPostInfo($page_access_token, $videoPostID['id']);
                FacebookPost::create([
                    'post_id' => $page_id . '_' . $videoPostInfo['post_id'],
                    'title' => $post->title,
                    'description' => $post->description,
                    'file_type' => 'video',
                    'file_path' => $post->file_path,
                    'facebook_page_id' => $post->facebook_page_id,
                    'original_link' => 'https://www.facebook.com' . $videoPostInfo['permalink_url']
                ]);
                return redirect()->route('publish', [
                    'pageID' => $post->facebook_page_id
                ])->banner('video duplicated successfully');
            }
        }

        $postID = $this->facebook->publishText($page_access_token, $page_id, $post->description);
        $postInfo = $this->facebook->postInfo($page_access_token, $postID['id']);
        FacebookPost::create([
            'post_id' => $postID['id'],
            'description' => $post->description,
            'facebook_page_id' => $post->facebook_page_id,
            'original_link' => $postInfo['permalink_url']
        ]);
        return redirect()->route('publish', [
            'pageID' => $post->facebook_page_id
        ])->banner('post duplicated successfully');
    }
}
