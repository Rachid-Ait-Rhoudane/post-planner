<?php

namespace App\Jobs;

use App\Services\Facebook;
use App\Models\FacebookPost;
use Illuminate\Bus\Queueable;
use App\Events\RefreshQueuedPosts;
use App\Events\RefreshPublishedPosts;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class RemovePostsFromQueue implements ShouldQueue
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
        if($this->facebookPost->file_type === 'video') {
            $videoPostInfo = $facebook->videoPostInfo($this->facebookPost->facebook_page->page_access_token, $this->facebookPost->post_id);
            if($videoPostInfo['published']) {
                $this->facebookPost->update([
                    'post_id' => $this->facebookPost->facebook_page->page_id . '_' . $videoPostInfo['post_id'],
                    'is_published' => true,
                    'original_link' => 'https://www.facebook.com' . $videoPostInfo['permalink_url'],
                    'job_id' => null
                ]);
            } else {
                throw new \Exception('post not published yet');
            }
        } else {
            $postInfo = $facebook->postInfo($this->facebookPost->facebook_page->page_access_token, $this->facebookPost->post_id);
            if($postInfo['is_published']) {
                $this->facebookPost->update([
                    'is_published' => true,
                    'original_link' => $postInfo['permalink_url'],
                    'job_id' => null
                ]);
            } else {
                throw new \Exception('post not published yet');
            }
        }
        RefreshQueuedPosts::dispatch($this->facebookPost->facebook_page_id);
        RefreshPublishedPosts::dispatch($this->facebookPost->facebook_page_id);
    }
}
