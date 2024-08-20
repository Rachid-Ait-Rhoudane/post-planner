<?php

namespace App\Http\Controllers\Channels\Facebook;

use Inertia\Inertia;
use App\Services\Facebook;
use App\Models\FacebookPage;
use App\Models\FacebookPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PublishToFacebookPageController extends Controller
{

    protected $facebook;

    public function __construct(Facebook $facebook) {

        $this->facebook = $facebook;
    }

    public function index(Request $request) {

        $page = FacebookPage::query()->when($request->query('pageID'), function($query, $pageID) {
            $query->where('id', $pageID);
        })->first();

        return Inertia::render('Publish', [
            'posts' => $page->posts()->where('is_published', true)->orderBy('created_at', 'desc')->paginate(5)->withQueryString(),
            'currentChannelID' => $page->id
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'description' => ['required']
        ]);

        $page = FacebookPage::findOrFail($request->input('channelID'));

        if($request->hasFile('file')) {

            $request->validate([
                'file' => ['mimetypes:application/pdf,image/jpeg,image/jpg,image/png,video/mp4'],
                'fileTitle' => ['required']
            ]);

            $file = $request->file('file');
            $filePath = Storage::disk('public')->put('/files', $file);
            $fileName = $file->getClientOriginalName();
            $fileLength = Storage::disk('public')->size($filePath);
            $fileType = Storage::disk('public')->mimeType($filePath);

            $uploadSessionID = $this->facebook->startUploadSession($request->user()->facebook_user_token, $fileName, $fileLength, $fileType);

            $uploadFileHandle = $this->facebook->startUpload($request->user()->facebook_user_token, $uploadSessionID, 0, Storage::disk('public')->get($filePath), $fileName);

            if(explode('/', $fileType)[0] === 'image') {
                $photoPostID = $this->facebook->publishPhoto($page->page_access_token, $page->page_id, $request->input('fileTitle'), $request->input('description'), $uploadFileHandle);
                $postInfo = $this->facebook->postInfo($page->page_access_token, $photoPostID['post_id']);
                FacebookPost::create([
                    'post_id' => $photoPostID['post_id'],
                    'title' => $request->input('fileTitle'),
                    'description' => $request->input('description'),
                    'file_type' => 'image',
                    'file_path' => $filePath,
                    'facebook_page_id' => $page->id,
                    'original_link' => $postInfo['permalink_url']
                ]);
                return redirect()->route('publish', [
                    'pageID' => $page->id
                ])->banner('photo published successfully');
            }

            if(explode('/', $fileType)[0] === 'video') {
                $videoPostID = $this->facebook->publishVideo($page->page_access_token, $page->page_id, $request->input('fileTitle'), $request->input('description'), $uploadFileHandle);
                $videoPostInfo = $this->facebook->videoPostInfo($page->page_access_token, $videoPostID['id']);
                FacebookPost::create([
                    'post_id' => $page->page_id . '_' . $videoPostInfo['post_id'],
                    'title' => $request->input('fileTitle'),
                    'description' => $request->input('description'),
                    'file_type' => 'video',
                    'file_path' => $filePath,
                    'facebook_page_id' => $page->id,
                    'original_link' => 'https://www.facebook.com' . $videoPostInfo['permalink_url']
                ]);
                return redirect()->route('publish', [
                    'pageID' => $page->id
                ])->banner('video published successfully');
            }
        }

        $postID = $this->facebook->publishText($page->page_access_token, $page->page_id, $request->input('description'));
        $postInfo = $this->facebook->postInfo($page->page_access_token, $postID['id']);
        FacebookPost::create([
            'post_id' => $postID['id'],
            'description' => $request->input('description'),
            'facebook_page_id' => $page->id,
            'original_link' => $postInfo['permalink_url']
        ]);
        return redirect()->route('publish', [
            'pageID' => $page->id
        ])->banner('post published successfully');
    }
}
