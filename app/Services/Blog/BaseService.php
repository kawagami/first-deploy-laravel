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
        return $this->repository->store($data)->toArray();
    }

    public function request()
    {
        return 'blog service';
    }
}
