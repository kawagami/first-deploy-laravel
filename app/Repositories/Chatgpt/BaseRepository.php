<?php

namespace App\Repositories\Chatgpt;

use App\Models\Chatgpt as Model;

class BaseRepository
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }
}
