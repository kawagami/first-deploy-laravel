<?php

namespace App\Services\Chatgpt;

use App\Repositories\Chatgpt\BaseRepository as Repository;
use OpenAI\Laravel\Facades\OpenAI;

class BaseService
{
    public $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function request(string $request_message)
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $request_message],
            ],
        ]);

        $response_message = data_get($response, "choices.0.message.content");

        $data = [
            "sent_message"            => $request_message,
            "data_id"                 => data_get($response, "id"),
            "object"                  => data_get($response, "object"),
            "created"                 => data_get($response, "created"),
            "model"                   => data_get($response, "model"),
            "usage_prompt_tokens"     => data_get($response, "usage.prompt_tokens"),
            "usage_completion_tokens" => data_get($response, "usage.completion_tokens"),
            "usage_total_tokens"      => data_get($response, "usage.total_tokens"),
            "choices_message_role"    => data_get($response, "choices.0.message.role"),
            "choices_message_content" => $response_message,
            "choices_finish_reason"   => data_get($response, "choices.0.finish_reason"),
            "choices_index"           => data_get($response, "choices.0.index"),
        ];

        $this->repository->create($data);

        return trim($response_message);
    }
}
