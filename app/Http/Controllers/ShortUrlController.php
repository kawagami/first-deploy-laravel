<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortUrlRequest;
use App\Http\Requests\UpdateShortUrlRequest;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('short-url');
    }

    /**
     * to destination of short url
     */
    public function teleport($short_url)
    {
        if ($short = ShortUrl::where('short_url', $short_url)->first()) {
            return redirect($short->destination);
        }

        return redirect(route('index'))->with('error', 'wrong url');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShortUrlRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShortUrlRequest $request)
    {
        $destination = data_get($request->validated(), 'destination');
        if ($isExisted =  ShortUrl::where('destination', $destination)->first()) {
            return response()->json(['short_url' => route('short-url.teleport', $isExisted->short_url)]);
        }
        // Str::random(20) 有可能跟現有的重複
        // 取得不重複 string 的部分待做
        $new = ShortUrl::create([
            "destination" => $destination,
            "short_url"   => Str::random(20),
        ]);
        return response()->json(['short_url' => route('short-url.teleport', $new->short_url)]);
    }
}
