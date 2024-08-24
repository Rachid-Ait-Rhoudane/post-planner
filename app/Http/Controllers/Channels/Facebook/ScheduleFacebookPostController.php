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
use Symfony\Component\HttpFoundation\Response;

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

        if($page) {
            $this->authorize('view', $page);
        } else {
            abort(Response::HTTP_NOT_FOUND);
        }

        return Inertia::render('Queue', [
            'posts' => $page ? $page->posts()
                                    ->where('is_published', false)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(5)
                                    ->withQueryString():
                                    [
                                        "data" => [],
                                        "links" => []
                                    ],
            'channelsExists' => FacebookPage::all()->count() ? true : false,
            'currentChannelID' => $page ? $page->id : 0
        ]);
    }

    public function store(Request $request) {

        $page = FacebookPage::findOrFail($request->input('channelID'));

        $this->authorize('postToChannel', $page);

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

        if($request->hasFile('file')) {

            $request->validate([
                'file' => ['mimetypes:image/jpeg,image/jpg,image/png,video/mp4'],
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
        $job = RemovePostsFromQueue::dispatch($facebookPost)->delay($date->addSeconds(30));
        logger($job->getJobId());
        return redirect()->route('queue', [
            'pageID' => $page->id
        ])->banner('post shceduled successfully');
    }

    public function update(Request $request) {

        $post = FacebookPost::findOrFail($request->input('postID'));
        $page = $post->facebook_page;

        $this->authorize('updatePost', $post);

        if($post->file_type === 'video') {
            $videoPostInfo = $this->facebook->videoPostInfo($page->page_access_token, $post->post_id);
            $pagePostID = $videoPostInfo['post_id'];
        } else {
            $pagePostID = $post->post_id;
        }

        if($request->date('date')) {
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
                'date' => ['date', 'after:'.$minDate, 'before:'.$maxDate]
            ]);
            $date = new Carbon($attributes['date'], $settings['timezone']);
        }

        if($request->hasFile('file')) {

            if($post->file_type === 'image') {
                $request->validate([
                    'file' => ['mimetypes:image/jpeg,image/jpg,image/png'],
                    'fileTitle' => ['required']
                ]);
            } elseif($post->file_type === 'video') {
                $request->validate([
                    'file' => ['mimetypes:video/mp4'],
                    'fileTitle' => ['required']
                ]);
            } else {
                return back()->withErrors([
                    'file' => 'Sorry, you cant update a text post to a image/video post !'
                ]);
            }

            Storage::disk('public')->delete($post->file_path);
            $file = $request->file('file');
            $filePath = Storage::disk('public')->put('/files', $file);
            $fileName = $file->getClientOriginalName();
            $fileLength = Storage::disk('public')->size($filePath);
            $fileType = Storage::disk('public')->mimeType($filePath);

            $uploadSessionID = $this->facebook->startUploadSession($request->user()->facebook_user_token, $fileName, $fileLength, $fileType);

            $uploadFileHandle = $this->facebook->startUpload($request->user()->facebook_user_token, $uploadSessionID, 0, Storage::disk('public')->get($filePath), $fileName);

            if(isset($date)) {
                $postUpdated = $this->facebook->updateFilePostAndScheduleTime($page->page_access_token, $pagePostID, $request->input('fileTitle'), $request->input('description'), $uploadFileHandle, $date->getTimestamp());
                $post->update([
                    'title' => $request->input('fileTitle'),
                    'description' => $request->input('description'),
                    'file_type' => explode('/', $fileType)[0],
                    'file_path' => $filePath,
                    'scheduled_time' => $date
                ]);
            } else {
                $postUpdated = $this->facebook->updateFilePost($page->page_access_token, $pagePostID, $request->input('fileTitle'), $request->input('description'), $uploadFileHandle);
                $post->update([
                    'title' => $request->input('fileTitle'),
                    'description' => $request->input('description'),
                    'file_type' => explode('/', $fileType)[0],
                    'file_path' => $filePath
                ]);
            }

            if(! $postUpdated['success']) {
                return redirect()->route('queue', [
                    'pageID' => $page->id
                ])->danger('something went wrong, please try again later');
            }

            return redirect()->route('queue', [
                'pageID' => $page->id
            ])->banner('post updated successfully');
        }

        if(isset($date)) {
            $postUpdated = $this->facebook->updatePostAndScheduleTime($page->page_access_token, $pagePostID, $request->input('description'), $date->getTimestamp());
            $post->update([
                'description' => $request->input('description'),
                'scheduled_time' => $date
            ]);
        } else {
            $postUpdated = $this->facebook->updatePost($page->page_access_token, $pagePostID, $request->input('description'));
            $post->update([
                'description' => $request->input('description')
            ]);
        }

        if(! $postUpdated['success']) {
            return redirect()->route('queue', [
                'pageID' => $page->id
            ])->danger('something went wrong, please try again later');
        }

        return redirect()->route('queue', [
            'pageID' => $page->id
        ])->banner('post updated successfully');
    }
}
