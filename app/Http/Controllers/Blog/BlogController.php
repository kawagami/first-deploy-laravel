<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogComponent;
use App\Models\Blog\BlogComponentArticle;
use App\Models\Blog\BlogComponentImage;

class BlogController extends Controller
{
    function read()
    {
        return response()->json([Blog::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = Blog::with([
        //     "components" => [
        //         "image",
        //         "article",
        //     ],
        // ])->find(3);
        return Blog::with([
            "components.image",
            "components.article",
        ])->find(3);

        $blog_data = [
            "user_id"       => 1,
            "name"          => "completetest01",
            "short_content" => "completetest01",
        ];
        $blog_result = Blog::create($blog_data);

        $component_data = [
            "blog_id" => $blog_result->id,
            "type"    => "3",
        ];
        $component_result = BlogComponent::create($component_data);

        $image_data = [
            "component_id"  => $component_result->id,
            "name"          => "completetest01",
            "url"           => "completetest01",
            "original_name" => "completetest01",
            "status"        => "0",
        ];
        $image_result = BlogComponentImage::create($image_data);

        $article_data = [
            "component_id" => $component_result->id,
            "content"      => "completetest01",
        ];
        $article_result = BlogComponentArticle::create($article_data);

        $data = Blog::with([
            "components" => [
                "image",
                "article",
            ],
        ])->find($blog_result->id);


        return response()->json([$data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("blog.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blog.create");
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
}
