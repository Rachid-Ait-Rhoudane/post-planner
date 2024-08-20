<?php

namespace App\Http\Controllers\Channels\Facebook;

use DateTime;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Services\Facebook;
use App\Models\FacebookPage;
use App\Models\FacebookPost;
use Illuminate\Http\Request;
use App\Jobs\RemovePostsFromQueue;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ScheduleFacebookPostController extends Controller
{

    protected $facebook;

    public function __construct(Facebook $facebook) {

        $this->facebook = $facebook;
    }

    public function index(Request $request) {

        $page = FacebookPage::query()->when($request->query('pageID'), function($query, $pageID) {
            $query->where('id', $pageID);
        })->first();

        return Inertia::render('Queue', [
            'posts' => $page->posts()->where('is_published', false)->orderBy('created_at', 'desc')->paginate(5)->withQueryString(),
            'currentChannelID' => $page->id
        ]);
    }

    public function store(Request $request) {

        $settings = $request->user()
                            ->settings()
                            ->select('setting_key', 'setting_value')
                            ->get()
                            ->mapWithKeys(function($e) {
                                return [$e['setting_key'] => $e['setting_value']];
                            });

        $minDate = (new Carbon('now', $settings['timezone']))->addMinutes(10);
        $maxDate = (new Carbon('now', $settings['timezone']))->addDays(30);

        $attributes = $request->validate([
            'description' => ['required'],
            'date' => ['required','date', 'after:'.$minDate, 'before:'.$maxDate]
        ]);

        $date = new Carbon($attributes['date'], $settings['timezone']);

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
                $photoPostID = $this->facebook->shcedulePhotoPost($page->page_access_token, $page->page_id, $request->input('fileTitle'), $request->input('description'), $uploadFileHandle, $date->getTimestamp());
                $facebookPost = FacebookPost::create([
                    'post_id' => $page->page_id . '_' . $photoPostID['id'],
                    'title' => $request->input('fileTitle'),
                    'description' => $request->input('description'),
                    'file_type' => 'image',
                    'file_path' => $filePath,
                    'facebook_page_id' => $page->id,
                    'is_published' => false,
                    'scheduled_time' => $date
                ]);
                RemovePostsFromQueue::dispatch($facebookPost)->delay($date->addSeconds(30));
                return redirect()->route('queue', [
                    'pageID' => $page->id
                ])->banner('photo scheduled successfully');
            }

            if(explode('/', $fileType)[0] === 'video') {
                $videoPostID = $this->facebook->scheduleVideoPost($page->page_access_token, $page->page_id, $request->input('fileTitle'), $request->input('description'), $uploadFileHandle, $date->getTimestamp());
                $facebookPost = FacebookPost::create([
                    'post_id' => $videoPostID['id'],
                    'title' => $request->input('fileTitle'),
                    'description' => $request->input('description'),
                    'file_type' => 'video',
                    'file_path' => $filePath,
                    'facebook_page_id' => $page->id,
                    'is_published' => false,
                    'scheduled_time' => $date
                ]);
                RemovePostsFromQueue::dispatch($facebookPost)->delay($date->addSeconds(30));
                return redirect()->route('queue', [
                    'pageID' => $page->id
                ])->banner('video scheduled successfully');
            }

        }

        $postID = $this->facebook->scheduleTextPost($page->page_access_token, $page->page_id, $request->input('description'), $date->getTimestamp());
        $facebookPost = FacebookPost::create([
            'post_id' => $postID['id'],
            'description' => $request->input('description'),
            'facebook_page_id' => $page->id,
            'is_published' => false,
            'scheduled_time' => $date
        ]);
        RemovePostsFromQueue::dispatch($facebookPost)->delay($date->addSeconds(30));
        return redirect()->route('queue', [
            'pageID' => $page->id
        ])->banner('post shceduled successfully');
    }
}
