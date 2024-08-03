<?php

namespace App\Http\Controllers\Channels\Facebook;

use Inertia\Inertia;
use App\Services\Facebook;
use App\Models\FacebookPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

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
            'pages' => FacebookPage::query()->when($request->query('search'), function($query, $search) {
                $query->where('page_name', 'LIKE', '%' . $search . '%');
            })->get(),
            'currentPageID' => $page->id
        ]);
    }

    public function store(Request $request) {

        Log::alert($request->file('file')->path());
        // $uploadSessionID = $this->facebook->startUploadSession($request->user()->facebook_user_token);
    }
}
