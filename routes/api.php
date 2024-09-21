<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChannelController;
use App\Http\Controllers\Api\UploadFileController;
use App\Http\Controllers\Api\PostAnalyticsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/channels', [ChannelController::class, 'index']);

Route::middleware('auth:sanctum')->post('/upload', [UploadFileController::class, 'store']);

Route::middleware('auth:sanctum')->get('/analytics/{facebook_post}', [PostAnalyticsController::class, 'show'])->name('post-analytics');
