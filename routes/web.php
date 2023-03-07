<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NoteController;
use App\Models\Image;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Socialite\GitHubController;
use App\Http\Controllers\Socialite\GoogleController;
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('auth/github', [GitHubController::class, 'redirect'])->name('github.login');
Route::get('auth/github/callback', [GitHubController::class, 'callback'])->name('github.callback');

Route::middleware(['auth'])->group(function () {
    // 縮址
    Route::get('/short-url', [ShortUrlController::class, 'index'])->name('short-url');
    // 新增新址
    Route::post('/short-url', [ShortUrlController::class, 'store'])->name('short-url.store');
});
// 跳轉到縮址紀錄的位置
Route::get('/short-url/{short_url}', [ShortUrlController::class, 'teleport'])->name('short-url.teleport');

Route::post('/lang/{lang}', function ($lang) {
    $langs = collect(config('app.locales'));
    if (!$langs->contains($lang)) {
        $lang = 'en';
    }
    session()->put('locale', $lang);
    return back();
})->name('lang');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/images', [AdminController::class, 'images'])->name('admin.images');
    Route::get('/short_urls', [AdminController::class, 'short_urls'])->name('admin.short_urls');
});
