<?php

use App\Models\Image;
use Illuminate\Support\Facades\Route;

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
    $image = 'storage/' . Image::first()->path;
    return view('kawa')->with('image', $image);
});

Route::get('/.well-known/acme-challenge/{token}', function ($token) {
    return $token . ".0nyemVIOXF4cpbD77MoDx8DpjP2tnKdhuBvwIarEjc8";
});
