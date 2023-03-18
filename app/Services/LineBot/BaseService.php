<?php

namespace App\Services\LineBot;

use App\Http\Controllers\ChatgptController;
use App\Repositories\LineBot\BaseRepository as Repository;
use Illuminate\Support\Str;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class BaseService
{
    public $auth_name;
    public $repository;
    public $chatgpt;

    public function __construct(Repository $repository, ChatgptController $chatgpt)
    {
        $this->repository = $repository;
        $this->chatgpt = $chatgpt;
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
            match (get_class($event)) {
                'LINE\LINEBot\Event\MessageEvent\TextMessage' => $this->handle_text_message($event, $bot),
                'LINE\LINEBot\Event\MessageEvent\AudioMessage' => $this->handle_audio_message($event, $bot),
                default => $this->handle_default($event, $bot),
            };
        }
    }

    private function handle_text_message($event, $bot)
    {
        // 處理兩邊
        $text = trim($event->getText());

        // 沒 input 有效文字
        if (strlen($text) === 0) {
            return;
        }

        // 非驚嘆號開頭 不處理
        if (!Str::startsWith($text, "!") && !Str::startsWith($text, "！")) {
            return;
        }

        // 把驚嘆號拿掉
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
        $chatgpt_response_message = $this->chatgpt->request($main_text);

        // 取得回復訊息必要的 token
        $replyToken = $event->getReplyToken();
        // 回復訊息
        $bot->replyText($replyToken, $chatgpt_response_message);
    }

    private function handle_audio_message($event, $bot)
    {

        // get content 的 api path 不同
        // 創建 LINE Bot 實例
        // https://developers.line.biz/en/reference/messaging-api/#get-content
        $httpClient = new CurlHTTPClient(env('LINE_ACCESS_TOKEN'));
        $audit_bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET'), 'endpointBase' => 'https://api-data.line.me']);

        $replyToken = $event->getReplyToken();
        $response = $audit_bot->getMessageContent($event->getMessageId());

        // 設定儲存路徑及檔名
        $filename = time() . '.mp3'; // 可自訂檔名，此處以時間為例
        $path = public_path('audio/' . $filename); // 儲存到 public/audio 資料夾下

        // 將檔案寫入本地端
        file_put_contents($path, $response->getRawBody());

        // 讀取給 whisper 的 stream
        $file = fopen($path, 'r');

        // 對 whisper 發問
        $whisper_message = $this->chatgpt->audio($file);

        // 關閉檔案
        fclose($file);
        unlink($path);

        $bot->replyText($replyToken, $whisper_message);
        // info($response->getHTTPStatus() . ' ' . $response->getRawBody());
    }

    /**
     * 未定義行為
     */
    private function handle_default($event, $bot)
    {
        $replyToken = $event->getReplyToken();
        $response   = $bot->replyText($replyToken, "GG");
    }
}
