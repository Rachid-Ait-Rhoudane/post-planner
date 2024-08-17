<?php

namespace App\Jobs;

use App\Services\Facebook;
use App\Models\FacebookPost;
use Illuminate\Bus\Queueable;
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
            $videoPostInfo = $this->facebook->videoPostInfo($this->facebookPost->page->page_access_token, $this->facebookPost->post_id);
            if($videoPostInfo['published']) {
                $this->facebookPost->update([
                    'post_id' => $this->facebookPost->page->page_id . '_' . $videoPostInfo['post_id'],
                    'is_published' => true,
                    'original_link' => $videoPostInfo['permalink_url']
                ]);
                return;
            } else {
                throw new \Exception('post not published yet');
            }
        }

        $postInfo = $this->facebook->postInfo($this->facebookPost->page->page_access_token, $this->facebookPost->post_id);
        if($postInfo['is_published']) {
            $this->facebookPost->update([
                'is_published' => true,
                'original_link' => $postInfo['permalink_url']
            ]);
        } else {
            throw new \Exception('post not published yet');
        }
    }
}
