<?php

namespace App\Repositories\Blog;

use App\Models\Blog\Blog as Model;
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
        Model $model,
        BlogComponent $component,
        BlogComponentArticle $article,
        BlogComponentImage $image
    ) {
        $this->model     = $model;
        $this->component = $component;
        $this->article   = $article;
        $this->image     = $image;
    }

    public function read(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with([
            "components.image",
            "components.article",
        ])->get();
    }

    public function store(array $data): Model
    {
        $blog_data = [
            "user_id"       => 1,
            "name"          => "completetest01",
            "short_content" => "completetest01",
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

    public function create(array $data)
    {
        $this->model->create($data);
    }
}
