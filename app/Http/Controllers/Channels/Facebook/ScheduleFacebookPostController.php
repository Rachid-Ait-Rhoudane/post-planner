<?php

namespace App\Http\Controllers\Channels\Facebook;

use DateTime;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Services\Facebook;
use App\Models\FacebookPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

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
            'currentChannelID' => $page->id
        ]);
    }

    public function store(Request $request) {

        $attributes = $request->validate([
            'description' => ['required'],
            'date' => ['required', 'after:now']
        ]);

        $page = FacebookPage::findOrFail($request->input('channelID'));

        $date = new Carbon($attributes['date'], 'Africa/Casablanca');

        Log::alert($date->getTimestamp());

        $postID = $this->facebook->scheduleTextPost($page->page_access_token, $page->page_id, $attributes['description'], $date->getTimestamp());

        Log::alert($date->format($postID));
    }
}
