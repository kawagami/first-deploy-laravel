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
        // $blog = $this->repository->store_blog([
        //     "name"          => data_get($data, "name"),
        //     "short_content" => data_get($data, "short_content"),
        // ]);

        // component
        $components = data_get($data, "components");

        return [
            $components
        ];

        // image

        // article

        return $this->repository->store($data)->toArray();
    }

    public function request()
    {
        return 'blog service';
    }
}
