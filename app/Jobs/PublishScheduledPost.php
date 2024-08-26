<?php

namespace App\Jobs;

use App\Services\Facebook;
use App\Models\FacebookPost;
use Illuminate\Bus\Queueable;
use App\Events\RefreshQueuedPosts;
use Illuminate\Support\Facades\Auth;
use App\Events\RefreshPublishedPosts;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PublishScheduledPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $facebookPost;

    public function __construct(FacebookPost $facebookPost)
    {
        $this->facebookPost = $facebookPost;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Facebook $facebook)
    {
        if($this->facebookPost->is_published) {
            RefreshQueuedPosts::dispatch($this->facebookPost->facebook_page_id);
            RefreshPublishedPosts::dispatch($this->facebookPost->facebook_page_id);
            return;
        }

        $page = $this->facebookPost->facebook_page;

        $userAccessToken = $page->user->facebook_user_token;

        if($this->facebookPost->file_type) {

            $file = Storage::disk('public')->get($this->facebookPost->file_path);
            $fileName = explode('/', $this->facebookPost->file_path)[1];
            $fileLength = Storage::disk('public')->size($this->facebookPost->file_path);
            $fileType = Storage::disk('public')->mimeType($this->facebookPost->file_path);

            $uploadSessionID = $facebook->startUploadSession($userAccessToken, $fileName, $fileLength, $fileType);

            $uploadFileHandle = $facebook->startUpload($userAccessToken, $uploadSessionID, 0, $file, $fileName);

            if($this->facebookPost->file_type === 'image') {
                $photoPostID = $facebook->publishPhoto($page->page_access_token, $page->page_id, $this->facebookPost->title, $this->facebookPost->description, $uploadFileHandle);
                $postInfo = $facebook->postInfo($page->page_access_token, $photoPostID['post_id']);
                $this->facebookPost->update([
                    'post_id' => $photoPostID['post_id'],
                    'original_link' => $postInfo['permalink_url'],
                    'is_published' => true,
                    'scheduled_time' => null,
                    'job_id' => null
                ]);
                RefreshQueuedPosts::dispatch($this->facebookPost->facebook_page_id);
                RefreshPublishedPosts::dispatch($this->facebookPost->facebook_page_id);
                return;
            }

            if($this->facebookPost->file_type === 'video') {
                $videoPostID = $facebook->publishVideo($page->page_access_token, $page->page_id, $this->facebookPost->title, $this->facebookPost->description, $uploadFileHandle);
                $videoPostInfo = $facebook->videoPostInfo($page->page_access_token, $videoPostID['id']);
                $this->facebookPost->update([
                    'post_id' => $page->page_id . '_' . $videoPostInfo['post_id'],
                    'original_link' => 'https://www.facebook.com' . $videoPostInfo['permalink_url'],
                    'is_published' => true,
                    'scheduled_time' => null,
                    'job_id' => null
                ]);
                RefreshQueuedPosts::dispatch($this->facebookPost->facebook_page_id);
                RefreshPublishedPosts::dispatch($this->facebookPost->facebook_page_id);
                return;
            }
        }

        $postID = $facebook->publishText($page->page_access_token, $page->page_id, $this->facebookPost->description);
        $postInfo = $facebook->postInfo($page->page_access_token, $postID['id']);
        $this->facebookPost->update([
            'post_id' => $postID['id'],
            'original_link' => $postInfo['permalink_url'],
            'is_published' => true,
            'scheduled_time' => null,
            'job_id' => null
        ]);

        RefreshQueuedPosts::dispatch($this->facebookPost->facebook_page_id);
        RefreshPublishedPosts::dispatch($this->facebookPost->facebook_page_id);
    }
}
