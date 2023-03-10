<?php

namespace App\Repositories\LineBot;

use App\Models\LineBot;

class BaseRepository
{
    public $line_bot;

    public function __construct(LineBot $line_bot)
    {
        $this->line_bot = $line_bot;
    }

    // 把此次 request 收到的資料記錄到資料庫
    public function record(array $data)
    {
        return $this->line_bot->create($data);
    }
}
