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
        return $this->model
            ->with([
                "components.image",
                "components.article",
            ])
            ->orderByDesc('updated_at')
            ->get();
    }

    public function store_blog(array $data): Blog
    {
        return $this->model->create($data);
    }

    public function store_component(array $data): BlogComponent
    {
        return $this->component->create($data);
    }

    public function store_article(array $data): BlogComponentArticle
    {
        return $this->article->create($data);
    }

    public function store_image(array $data): BlogComponentImage
    {
        return $this->image->create($data);
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }
}
