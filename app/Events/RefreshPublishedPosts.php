<?php

namespace App\Events;

use App\Models\FacebookPost;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RefreshPublishedPosts implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pageID;
    public $publishedPosts;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($pageID)
    {
        $this->pageID = $pageID;
        $this->publishedPosts = FacebookPost::where('facebook_page_id', $pageID)
                                            ->where('is_published', true)
                                            ->orderBy('created_at', 'desc')
                                            ->paginate(5)
                                            ->withPath('/publish')
                                            ->appends([
                                                "pageID" => $pageID
                                            ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('refresh-posts-' . $this->pageID);
    }
}
