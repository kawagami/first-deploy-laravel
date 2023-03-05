<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\ShortUrl;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_count      = User::count();
        $short_urls_count = ShortUrl::count();
        $images_count     = Image::count();
        $data = [
            'users_count'      => $users_count,
            'short_urls_count' => $short_urls_count,
            'images_count'     => $images_count,
        ];
        return view('admin.index', ['data' => $data]);
    }
    public function images()
    {
        $images = Image::get();
        $data   = [
            'images' => $images,
        ];
        return view('admin.images', ['data' => $data]);
    }
    public function short_urls()
    {
        $short_urls = ShortUrl::with('user')->get();
        $data       = [
            'short_urls' => $short_urls,
        ];
        return view('admin.short_urls', ['data' => $data]);
    }
    public function users()
    {
        $users = User::get();
        $data  = [
            'users' => $users,
        ];
        return view('admin.users', ['data' => $data]);
    }
}
