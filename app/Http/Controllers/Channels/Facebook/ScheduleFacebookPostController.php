<?php

namespace App\Http\Controllers\Channels\Facebook;

use DateTime;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Services\Facebook;
use App\Models\FacebookPage;
use App\Models\FacebookPost;
use Illuminate\Http\Request;
use App\Jobs\PublishScheduledPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Bus\Dispatcher;
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

        $now = new Carbon('now', $settings['timezone']);
        $attributes = $request->validate([
            'description' => ['required'],
            'date' => ['required','date', 'after:' . $now]
        ]);

        $attributes['description'] = strip_tags($attributes['description']);

        $date = new Carbon($attributes['date'], $settings['timezone']);

        if($request->hasFile('file')) {

            $request->validate([
                'file' => ['mimetypes:image/jpeg,image/jpg,image/png,video/mp4'],
                'fileTitle' => ['required']
            ]);

            $file = $request->file('file');
            $filePath = Storage::disk('public')->put('/files', $file);
            $fileType = Storage::disk('public')->mimeType($filePath);

            if(explode('/', $fileType)[0] === 'image') {
                $facebookPost = FacebookPost::create([
                    'title' => $request->input('fileTitle'),
                    'description' => $attributes['description'],
                    'file_type' => 'image',
                    'file_path' => $filePath,
                    'facebook_page_id' => $page->id,
                    'is_published' => false,
                    'scheduled_time' => $date
                ]);
                $job = new PublishScheduledPost($facebookPost);
                $job->delay($date);
                $jobId = app(Dispatcher::class)->dispatch($job);
                $facebookPost->update([
                    'job_id' => $jobId
                ]);
                return redirect()->route('queue', [
                    'pageID' => $page->id
                ])->banner('photo scheduled successfully');
            }

            if(explode('/', $fileType)[0] === 'video') {
                $facebookPost = FacebookPost::create([
                    'title' => $request->input('fileTitle'),
                    'description' => $attributes['description'],
                    'file_type' => 'video',
                    'file_path' => $filePath,
                    'facebook_page_id' => $page->id,
                    'is_published' => false,
                    'scheduled_time' => $date
                ]);
                $job = new PublishScheduledPost($facebookPost);
                $job->delay($date);
                $jobId = app(Dispatcher::class)->dispatch($job);
                $facebookPost->update([
                    'job_id' => $jobId
                ]);
                return redirect()->route('queue', [
                    'pageID' => $page->id
                ])->banner('video scheduled successfully');
            }
        }
        $facebookPost = FacebookPost::create([
            'description' => $attributes['description'],
            'facebook_page_id' => $page->id,
            'is_published' => false,
            'scheduled_time' => $date
        ]);
        $job = new PublishScheduledPost($facebookPost);
        $job->delay($date);
        $jobId = app(Dispatcher::class)->dispatch($job);
        $facebookPost->update([
            'job_id' => $jobId
        ]);
        return redirect()->route('queue', [
            'pageID' => $page->id
        ])->banner('post shceduled successfully');
    }

    public function update(Request $request) {

        $post = FacebookPost::findOrFail($request->input('postID'));
        $page = $post->facebook_page;

        $this->authorize('updatePost', $post);

        if($request->date('date')) {
            $settings = $request->user()
                                ->settings()
                                ->select('setting_key', 'setting_value')
                                ->get()
                                ->mapWithKeys(function($e) {
                                    return [$e['setting_key'] => $e['setting_value']];
                                });

            $now = new Carbon('now', $settings['timezone']);
            $attributes = $request->validate([
                'date' => ['date', 'after:'. $now]
            ]);
            $date = new Carbon($attributes['date'], $settings['timezone']);
            DB::table('jobs')
                ->where('id', $post->job_id)
                ->update([
                    "available_at" => $date->getTimestamp()
                ]);
        }

        if($request->hasFile('file')) {

            $request->validate([
                'file' => ['mimetypes:image/jpeg,image/jpg,image/png,video/mp4'],
                'fileTitle' => ['required']
            ]);

            if(Storage::disk('public')->exists($post->file_path ?? 'no-post-file')) {
                Storage::disk('public')->delete($post->file_path);
            };

            $file = $request->file('file');
            $filePath = Storage::disk('public')->put('/files', $file);
            $fileType = Storage::disk('public')->mimeType($filePath);

            $description = strip_tags($request->input('description'));

            if(isset($date)) {
                $post->update([
                    'title' => $request->input('fileTitle'),
                    'description' => $description,
                    'file_type' => explode('/', $fileType)[0],
                    'file_path' => $filePath,
                    'scheduled_time' => $date
                ]);
            } else {
                $post->update([
                    'title' => $request->input('fileTitle'),
                    'description' => $description,
                    'file_type' => explode('/', $fileType)[0],
                    'file_path' => $filePath
                ]);
            }

            return redirect()->route('queue', [
                'pageID' => $page->id
            ])->banner('post updated successfully');
        }

        if(isset($date)) {
            $post->update([
                'description' => $description,
                'scheduled_time' => $date
            ]);
        } else {
            $post->update([
                'description' => $description
            ]);
        }

        return redirect()->route('queue', [
            'pageID' => $page->id
        ])->banner('post updated successfully');
    }

    public function destroy(FacebookPost $facebookPost) {

        DB::table('jobs')
            ->where('id', $facebookPost->job_id)
            ->delete();
        if(Storage::disk('public')->exists($facebookPost->file_path ?? 'no-post-file')) {
            Storage::disk('public')->delete($facebookPost->file_path);
        };
        $facebookPost->delete();
        return redirect()->route('queue', [
            'pageID' => $facebookPost->facebook_page->id
        ])->banner('post deleted successfully');
    }
}
