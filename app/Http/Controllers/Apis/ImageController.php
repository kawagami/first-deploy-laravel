<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Image::select(['name', 'url'])->get();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file     = $request->file('file');
            $fileName = $file->getClientOriginalName();

            // Storage::put 會存放在 /storage/app 下
            $path     = Storage::put('public', $file);
            $basename = basename($path);
            $data     = [
                "user_id"       => $request->user()->id,
                "name"          => $basename,
                "url"           => asset("storage/{$basename}"),
                "original_name" => $fileName,
            ];

            $image            = Image::create($data);
            $data['image_id'] = $image->id;

            unset($data["user_id"]);

            return response($data, 201);
        } else {
            return response([
                'message' => '未找到上传文件'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove all temp images
     *
     * @return void
     */
    public function destroy_all()
    {
        $images = Image::where('status', '0')->get();

        foreach ($images as $image) {
            Storage::delete('public/' . $image->name);
            $image->delete();
        }
    }
}
