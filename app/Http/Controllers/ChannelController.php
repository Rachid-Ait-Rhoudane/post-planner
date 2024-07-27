<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\FacebookPage;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index() {

        return Inertia::render('Channels', [
            'channels' => FacebookPage::paginate(8)
        ]);
    }
}
