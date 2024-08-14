<?php

namespace App\Http\Controllers\Channels\Facebook;

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
            'date' => ['required', 'after:now']
        ]);

        $date = new Carbon($attributes['date']);

        Log::alert($date->getTimestamp());
    }
}
