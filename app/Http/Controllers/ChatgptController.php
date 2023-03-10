<?php

namespace App\Http\Controllers;

use App\Models\Chatgpt;
use App\Models\ChatgptError;
use Illuminate\Support\Facades\Http;

class ChatgptController extends Controller
{
    public static function request(string $request_message)
    {
        $response = Http::withHeaders(
            [
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . env('CHATGPT_API_KEY'),
            ]
        )->post(
            'https://api.openai.com/v1/chat/completions',
            [
                'model'       => 'gpt-3.5-turbo',
                'messages'    => [
                    [
                        'role'    => 'user',
                        'content' => $request_message
                    ]
                ],
                'temperature' => 0.7,
            ]
        );
        if (data_get($response, "error") !== null) {
            $error_data = [
                "sent_message" => $request_message,
                "message"      => data_get($response, "error.message"),
                "type"         => data_get($response, "error.type"),
                "param"        => data_get($response, "error.param"),
                "code"         => data_get($response, "error.code"),
            ];
            ChatgptError::create($error_data);
            return "error";
        } else {
            $success_data = [
                "sent_message"            => $request_message,
                "data_id"                 => data_get($response, "id"),
                "object"                  => data_get($response, "object"),
                "created"                 => data_get($response, "created"),
                "model"                   => data_get($response, "model"),
                "usage_prompt_tokens"     => data_get($response, "usage.prompt_tokens"),
                "usage_completion_tokens" => data_get($response, "usage.completion_tokens"),
                "usage_total_tokens"      => data_get($response, "usage.total_tokens"),
                "choices_message_role"    => data_get($response, "choices.0.message.role"),
                "choices_message_content" => data_get($response, "choices.0.message.content"),
                "choices_finish_reason"   => data_get($response, "choices.0.finish_reason"),
                "choices_index"           => data_get($response, "choices.0.index"),
            ];
            Chatgpt::create($success_data);
            return trim(data_get($response, "choices.0.message.content"));
        }
    }
}
