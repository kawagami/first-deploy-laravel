<?php

namespace App\Http\Controllers;

use App\Models\Chatgpt;
use App\Models\ChatgptError;
use OpenAI\Laravel\Facades\OpenAI;

class ChatgptController extends Controller
{
    public static function request(string $request_message)
    {
        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $request_message],
                ],
            ]);

            if (data_get($response, "error") !== null) {
                $error_data = [
                    "sent_message" => $request_message,
                    "message"      => data_get($response, "error.message"),
                    "type"         => data_get($response, "error.type"),
                    "param"        => data_get($response, "error.param"),
                    "code"         => data_get($response, "error.code"),
                ];
                ChatgptError::create($error_data);
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
                    "choices_finish_reason"   => data_get($response, "choices.0.finish_reason", "stop_error") ?? "stop_error",
                    "choices_index"           => data_get($response, "choices.0.index"),
                ];
                Chatgpt::create($success_data);

                return trim(data_get($response, "choices.0.message.content"));
            }
        } catch (\Exception $error) {
            info($error->getMessage());

            return $error->getMessage();
        }

        return "error";
    }
}
