<?php

use App\Http\Controllers\Apis\ThumborController;
use App\Http\Controllers\Apis\AdminController;
use App\Http\Controllers\Apis\UploadImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\LineBotController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/upload-image', [UploadImageController::class, 'store']);

// LINE
Route::post('/line-bot', [LineBotController::class, 'handleRequest']);

// admin
Route::middleware('auth:sanctum')->get('/admin', [AdminController::class, 'index']);
// Route::get('/admin', [AdminController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/thumbor', [ThumborController::class, 'get_spec_string'])->name('api.thumbor');
});
