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

        $page = FacebookPage::query()->when($request->query('page_id'), function($query, $page_id) {
            $query->where('id', $page_id);
        })->first();

        $posts = $this->facebook->posts($page->page_access_token, $page->page_id, $request->query('before') ?? '', $request->query('after') ?? '');

        if(! $posts) {
            // return redirect()->route('p')->dangerBanner('Something went wrong please try again later');
        }

        return Inertia::render('Publish', [
            'posts' => $posts['data'],
            'paging' => $posts['paging']
        ]);
    }
}
