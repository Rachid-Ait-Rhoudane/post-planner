<?php

namespace App\Http\Controllers\Api;

use App\Services\Facebook;
use App\Models\FacebookPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PostAnalyticsController extends Controller
{

    protected $facebook;

    public function __construct(Facebook $facebook) {

        $this->facebook = $facebook;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FacebookPost $facebookPost)
    {

        $this->authorize('viewPostAnalytics', $facebookPost);

        $page = $facebookPost->facebook_page;

        $analytics = $this->facebook->postAnalytics($page->page_access_token, $facebookPost->post_id);

        if(! $analytics) {
            //
        }

        return response()->json([
            'reactions' => $analytics['reactions']['summary']['total_count'],
            'comments' => $analytics['comments']['summary']['total_count'],
            'shares' => $analytics->has('shares') ? $analytics['shares']['count'] : 0
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
