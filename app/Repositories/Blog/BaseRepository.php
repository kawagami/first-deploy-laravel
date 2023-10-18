<?php

namespace App\Repositories\Blog;

use App\Models\Blog\Blog;
use App\Models\Blog\BlogComponent;
use App\Models\Blog\BlogComponentArticle;
use App\Models\Blog\BlogComponentImage;

class BaseRepository
{
    public $model;
    public $component;
    public $article;
    public $image;

    public function __construct(
        Blog $model,
        BlogComponent $component,
        BlogComponentArticle $article,
        BlogComponentImage $image
    ) {
        $this->model     = $model;
        $this->component = $component;
        $this->article   = $article;
        $this->image     = $image;
    }

    public function read_one($id): Blog
    {
        return $this->model->with([
            "components.image",
            "components.article",
        ])->find($id);
    }

    public function read(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with([
            "components.image",
            "components.article",
        ])->get();
    }

    public function store(array $data): Blog
    {
        $blog_data = [
            "user_id"       => 1,
            "name"          => data_get($data, "name"),
            "short_content" => data_get($data, "short_content"),
        ];
        $blog_result = $this->model->create($blog_data);

        $component_data = [
            "blog_id" => $blog_result->id,
            "type"    => "3",
        ];
        $component_result = $this->component->create($component_data);

        $image_data = [
            "component_id"  => $component_result->id,
            "name"          => "completetest01",
            "url"           => "completetest01",
            "original_name" => "completetest01",
            "status"        => "0",
        ];
        $image_result = $this->image->create($image_data);

        $article_data = [
            "component_id" => $component_result->id,
            "content"      => "completetest01",
        ];
        $article_result = $this->article->create($article_data);

        $data = $this->model->with([
            "components" => [
                "image",
                "article",
            ],
        ])->find($blog_result->id);

        return $data;
    }

    public function store_blog(array $data): Blog
    {
        return $this->model->create([
            "user_id"       => data_get($data, "user_id"),
            "name"          => data_get($data, "name"),
            "short_content" => data_get($data, "short_content"),
        ]);
    }

    public function store_component(array $data): BlogComponent
    {
        return $this->component->create([
            "blog_id" => data_get($data, "blog_id"),
            "type"    => data_get($data, "type"),
        ]);
    }

    public function store_article(array $data): BlogComponentArticle
    {
        return $this->article->create([
            "component_id" => data_get($data, "component_id"),
            "content"      => data_get($data, "content"),
        ]);
    }

    public function store_image(array $data): BlogComponentImage
    {
        return $this->image->create([
            "component_id"  => data_get($data, "component_id"),
            "name"          => data_get($data, "name"),
            "url"           => data_get($data, "url"),
            "original_name" => data_get($data, "original_name"),
            "status"        => "0",
        ]);
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }
}
