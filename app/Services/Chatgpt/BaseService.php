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

    public function audio($file)
    {
        $response = OpenAI::audio()->transcribe([
            'model' => 'whisper-1',
            'file' => $file,
            'response_format' => 'verbose_json',
        ]);

        // $response->task; // 'transcribe'
        // $response->language; // 'english'
        // $response->duration; // 2.95
        return $response->text; // 'Hello, how are you?'

        // foreach ($response->segments as $segment) {
        //     $segment->index; // 0
        //     $segment->seek; // 0
        //     $segment->start; // 0.0
        //     $segment->end; // 4.0
        //     $segment->text; // 'Hello, how are you?'
        //     $segment->tokens; // [50364, 2425, 11, 577, 366, 291, 30, 50564]
        //     $segment->temperature; // 0.0
        //     $segment->avgLogprob; // -0.45045216878255206
        //     $segment->compressionRatio; // 0.7037037037037037
        //     $segment->noSpeechProb; // 0.1076972484588623
        //     $segment->transient; // false
        // }

        // return trim($response_message);
    }
}
