<?php

use App\Http\Controllers\Apis\ThumborController;
use App\Http\Controllers\Apis\AdminController;
use App\Http\Controllers\Apis\UploadImageController;
use App\Http\Controllers\Apis\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\LineBotController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\SgViteController;
use App\Http\Controllers\User\UserController;

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

// sg-vite
Route::get('/sg-vite', [SgViteController::class, 'index']);

Route::prefix('user')->group(function () {
    Route::post('/', [UserController::class, 'index'])->middleware('sgtoken');
    Route::get('/info', [UserController::class, 'index'])->middleware('sgtoken');
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/token_check', [UserController::class, 'token_check']);
});

Route::middleware('sgtoken')->group(function () {
    Route::get('/image', [ImageController::class, 'index']);
    Route::post('/image', [ImageController::class, 'store']);
    Route::delete('/delete-all-image', [ImageController::class, 'destroy_all']);

});
// blog
Route::get('/blog', [BlogController::class, 'read']);
Route::post('/blog', [BlogController::class, 'store']);
