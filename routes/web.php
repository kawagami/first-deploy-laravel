<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Blog\BlogController;
use App\Models\Image;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Socialite\GitHubController;
use App\Http\Controllers\Socialite\GoogleController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Hackmd\HackmdNoteListController;
use App\Http\Controllers\ThumborController;

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
    return redirect()->away('https://next-blog.kawa.homes');
})->name('index');

Route::get('/.well-known/acme-challenge/{token}', function ($token) {
    return $token . ".0nyemVIOXF4cpbD77MoDx8DpjP2tnKdhuBvwIarEjc8";
});

Route::get('/note', [HackmdNoteListController::class, 'index'])->name('note');

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

    // thumbor
    // Route::get('/thumbor', [ThumborController::class, 'index'])->name('thumbor');
});
// 跳轉到縮址紀錄的位置
Route::get('/short-url/{short_url}', [ShortUrlController::class, 'teleport'])->name('short-url.teleport');

Route::post('/lang/{lang}', [LanguageController::class, 'lang'])->name('lang');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/images', [AdminController::class, 'images'])->name('admin.images');
    Route::get('/short_urls', [AdminController::class, 'short_urls'])->name('admin.short_urls');

});

Route::prefix('blog')->group(function () {
    // index
    Route::get('/', [BlogController::class, 'get_all'])->name('blog.index');
    // show
    Route::get('/{id}', [BlogController::class, 'get_one'])->name('blog.show');
});
