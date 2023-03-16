<?php

namespace App\Services\LineBot;

use App\Http\Controllers\ChatgptController;
use App\Repositories\LineBot\BaseRepository as Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class BaseService
{
    public $auth_name;
    public $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle_request()
    {

        // 創建 LINE Bot 實例
        $httpClient = new CurlHTTPClient(env('LINE_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

        // 解析 LINE Bot 請求
        $signature = $_SERVER['HTTP_' . LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
        $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);

        // 遍歷所有事件並回復一條消息
        foreach ($events as $event) {
            // 目前只處理文字訊息
            if ($event instanceof LINEBot\Event\MessageEvent\TextMessage) {

                $text = trim($event->getText());
                // 沒 input 有效文字
                if (strlen($text) === 0) {
                    continue;
                }
                // 非驚嘆號開頭 不處理
                if (!Str::startsWith($text, "!") && !Str::startsWith($text, "！")) {
                    continue;
                }
                $main_text = Str::substr($text, 1);

                $message_data = [
                    'type'            => $event->getType(),
                    'timestamp'       => $event->getTimestamp(),
                    'reply_token'     => $event->getReplyToken(),
                    'user_id'         => $event->getUserId(),
                    'event_source_id' => $event->getEventSourceId(),
                    'text'            => $text,
                ];
                $this->repository->record($message_data);

                // 對 chatgpt 發問
                $chatgpt_response_message = ChatgptController::request($main_text);

                $replyToken = $event->getReplyToken();
                $response   = $bot->replyText($replyToken, $chatgpt_response_message);
                if ($response->isSucceeded()) {
                    return true;
                } else {
                    info($response->getHTTPStatus() . ' ' . $response->getRawBody());
                    return false;
                }
            } elseif ($event instanceof LINEBot\Event\MessageEvent\AudioMessage) {

                $replyToken = $event->getReplyToken();
                // $response = $bot->getMessageContent($event->getMessageId());
                // $getRawBody = $response->getRawBody();
                // info($getRawBody);
                $response   = $bot->replyText($replyToken, "這是聲音檔");
            }
        }
    }
}
