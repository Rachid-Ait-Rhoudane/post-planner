<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthWithGoogleController;
use App\Http\Controllers\Channels\Facebook\DuplicatePostController;
use App\Http\Controllers\Channels\Facebook\FacebookPageChannelController;
use App\Http\Controllers\Channels\Facebook\ScheduleFacebookPostController;
use App\Http\Controllers\Channels\Facebook\PublishToFacebookPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {

    Route::get('/auth/google/redirect', [AuthWithGoogleController::class, 'create'])->name('auth-google-redirect');
    Route::get('/auth/google/callback', [AuthWithGoogleController::class, 'store'])->name('auth-google-callback');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/settings', [SettingController::class, 'edit'])->name('profile.settings');

    Route::put('/settings/{user}', [SettingController::class, 'update'])->name('profile.settings.update');

    Route::get('/channels', [ChannelController::class, 'index'])->name('channels');

    Route::get('/connect/facebook/pages/redirect', [FacebookPageChannelController::class, 'create'])->name('connect-facebook-pages-redirect');
    Route::get('/connect/facebook/pages/callback', [FacebookPageChannelController::class, 'store'])->name('connect-facebook-pages-callback');
    Route::put('/facebook/page/refresh/connection/{facebookPage}', [FacebookPageChannelController::class, 'update'])->name('facebook-page-refresh-connection');
    Route::delete('/facebook/page/destroy/{facebookPage}', [FacebookPageChannelController::class, 'destroy'])->name('facebook-page-destroy');

    Route::get('/publish', [PublishToFacebookPageController::class, 'index'])->name('publish');
    Route::post('/publish/post', [PublishToFacebookPageController::class, 'store'])->name('publish-post');
    Route::post('/duplicate/post', [DuplicatePostController::class, 'store'])->name('duplicate-post');

    Route::get('/queue', [ScheduleFacebookPostController::class, 'index'])->name('queue');
    Route::post('/queue/post', [ScheduleFacebookPostController::class, 'store'])->name('queue-post');
});
