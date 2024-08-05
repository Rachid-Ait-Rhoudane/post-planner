<?php

namespace App\Http\Controllers\Channels\Facebook;

use Inertia\Inertia;
use App\Services\Facebook;
use App\Models\FacebookPage;
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

        $posts = $this->facebook->posts($page->page_access_token, $page->page_id, $request->query('before') ?? '', $request->query('after') ?? '');

        if(! $posts) {
            // return redirect()->route('p')->dangerBanner('Something went wrong please try again later');
        }

        return Inertia::render('Publish', [
            'posts' => $posts['data'],
            'paging' => $posts['paging'],
            'currentPageID' => $page->id
        ]);
    }

    public function store(Request $request) {

        // $file = $request->file('file');
        // $filePath = Storage::disk('public')->put('/files', $file);
        // $fileName = $file->getClientOriginalName();
        // $fileLength = Storage::disk('public')->size($filePath);
        // $fileType = Storage::disk('public')->mimeType($filePath);

        // $uploadSessionID = $this->facebook->startUploadSession($request->user()->facebook_user_token, $fileName, $fileLength, $fileType);

        // $uploadFileHandle = $this->facebook->startUpload($request->user()->facebook_user_token, $uploadSessionID, 0, Storage::disk('public')->get($filePath), $fileName);

        $page = FacebookPage::findOrFail($request->input('channelID'));

        // $videoPostID = $this->facebook->publishPhoto($page->page_access_token, $page->page_id, $request->input('fileTitle'), $request->input('description'), $uploadFileHandle);

        // Log::alert($videoPostID);

        $videoPostID = $this->facebook->publishText($page->page_access_token, $page->page_id, $request->input('description'));

        Log::alert($videoPostID);
    }
}
