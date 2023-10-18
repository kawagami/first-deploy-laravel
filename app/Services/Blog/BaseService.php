<?php

namespace App\Services\Blog;

use App\Repositories\Blog\BaseRepository as Repository;

class BaseService
{
    public $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function read(): array
    {
        return $this->repository->read()->toArray();
    }

    public function store(array $data): array
    {
        // blog
        $blog_result = $this->repository->store_blog([
            "user_id"       => 1,
            "name"          => data_get($data, "name"),
            "short_content" => data_get($data, "short_content"),
        ]);

        // component
        $components = data_get($data, "components");

        if (empty($components)) {
            throw new \Exception("components can't be empty", 400);
        }

        foreach ($components as $component) {
            $image   = data_get($component, "image");
            $article = data_get($component, "article");

            if (empty($image) && empty($article)) {
                throw new \Exception("component 需要有內容", 400);
            }

            // 未定義 type
            $type = '0';

            // 判斷 type 1:文字 2:圖片 3:文字+圖片
            if (empty($image) && !empty($article)) {
                $type = '1';
            }

            if (!empty($image) && empty($article)) {
                $type = '2';
            }

            if (!empty($image) && !empty($article)) {
                $type = '3';
            }

            $component_result = $this->repository->store_component([
                "blog_id" => $blog_result->id,
                "type"    => $type,
            ]);

            // image
            if (!empty($image)) {
                $image_result = $this->repository->store_image([
                    "component_id"  => $component_result->id,
                    "name"          => data_get($image, "name"),
                    "url"           => data_get($image, "url"),
                    "original_name" => data_get($image, "original_name"),
                ]);
            }

            // article
            if (!empty($article)) {
                $article_result = $this->repository->store_article([
                    "component_id" => $component_result->id,
                    "content"      => data_get($article, "content"),
                ]);
            }
        }

        return $this->repository->read_one($blog_result->id)->toArray();
    }

    public function request()
    {
        return 'blog service';
    }
}
