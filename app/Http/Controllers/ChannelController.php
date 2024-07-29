<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\FacebookPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChannelController extends Controller
{
    public function index(Request $request) {

        return Inertia::render('Channels', [
            'channels' => FacebookPage::query()
                                    ->where('user_id', $request->user()->id)
                                    ->when($request->query('search'), function ($query, $search) {
                                        $query->where('page_name', 'LIKE', '%' . $search  .'%');
                                    })
                                    ->paginate(8)
                                    ->withQueryString(),
            'filters' => [
                'search' => $request->query('search')
            ]
        ]);
    }
}
