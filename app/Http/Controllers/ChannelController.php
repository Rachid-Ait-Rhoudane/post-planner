<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\FacebookPage;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index(Request $request) {

        return Inertia::render('Channels', [
            'channels' => FacebookPage::query()
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
