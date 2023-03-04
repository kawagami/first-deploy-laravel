<?php

use App\Http\Controllers\NoteController;
use App\Models\Image;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\App;

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

Route::get('/', function () {
    if (Image::first() !== null) {
        $image = 'storage/' . Image::first()->path;
    } else {
        $image = '';
    }
    return view('index')->with('image', $image);
})->name('index');

Route::get('/.well-known/acme-challenge/{token}', function ($token) {
    return $token . ".0nyemVIOXF4cpbD77MoDx8DpjP2tnKdhuBvwIarEjc8";
});

Route::get('/note', [NoteController::class, 'index'])->name('note');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/google', [GoogleController::class, 'gitRedirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'gitCallback'])->name('google.callback');

Route::get('auth/github', [GitHubController::class, 'gitRedirect'])->name('github.login');
Route::get('auth/github/callback', [GitHubController::class, 'gitCallback'])->name('github.callback');

Route::middleware(['auth'])->group(function () {
    // 縮址
    Route::get('/short-url', [ShortUrlController::class, 'index'])->name('short-url');
    // 新增新址
    Route::post('/short-url', [ShortUrlController::class, 'store'])->name('short-url.store');
});
// 跳轉到縮址紀錄的位置
Route::get('/short-url/{short_url}', [ShortUrlController::class, 'teleport'])->name('short-url.teleport');

Route::post('/lang/{lang}', function ($lang) {
    if ($lang != 'zh-TW') {
        $lang = 'en';
    }
    session()->put('locale', $lang);
    return back();
})->name('lang');
