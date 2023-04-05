<?php

namespace App\Http\Controllers\Hackmd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\HackmdNote;
use App\Models\HackmdTag;
use Illuminate\Support\Facades\DB;

class HackmdNoteController extends Controller
{
    public static function get_note(string $note_id): string|null
    {
        // 統計資料
        $start = microtime(true);
        $count_create = 0;
        $count_update = 0;

        DB::beginTransaction();
        try {
            // 組合 url
            $base_url = 'https://api.hackmd.io/v1/notes/';
            $url      = sprintf('%s%s', $base_url, $note_id);

            // 發出 request
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('HACKMD_TOKEN'),
            ])->get($url);

            // 200 以外報錯
            $response->throwUnlessStatus(200);

            // 整理資料
            $note = $response->collect();
            $insert_data = [
                "hackmd_note_id"  => $note->get("id"),
                "title"           => $note->get("title"),
                "createdAt"       => $note->get("createdAt"),
                "publishType"     => $note->get("publishType"),
                "publishedAt"     => $note->get("publishedAt"),
                "permalink"       => $note->get("permalink"),
                "publishLink"     => $note->get("publishLink"),
                "shortId"         => $note->get("shortId"),
                "content"         => $note->get("content"),
                "lastChangedAt"   => $note->get("lastChangedAt"),
                "lastChangeUser"  => $note->get("lastChangeUser"),
                "userPath"        => $note->get("userPath"),
                "teamPath"        => $note->get("teamPath"),
                "readPermission"  => $note->get("readPermission"),
                "writePermission" => $note->get("writePermission"),
            ];

            // 判斷是否有這筆資料
            $old_note = HackmdNote::where("hackmd_note_id", $note->get("id"))->first();

            // 沒有 note 資料的話新增
            if ($old_note === null) {
                $new_note = HackmdNote::create($insert_data);

                // 處理 tags
                $tag_ids = [];
                foreach ($note->get("tags") as $tag) {
                    // 取得該名稱的 tag
                    $new_tag = HackmdTag::where('name', $tag)->firstOrCreate(["name" => $tag]);

                    // 把屬於此份 note 的 tag id 丟進 array
                    $tag_ids[] = $new_tag->id;
                }
                // 加上 tag 關聯
                $new_note->tags()->attach($tag_ids);

                $count_create++;
            } elseif ($old_note->lastChangedAt < $note->get("lastChangedAt")) {
                // 更新資料
                $old_note->update($insert_data);

                // 清掉 tags
                $old_note->tags()->detach();

                // 處理 tags
                $tag_ids = [];
                foreach ($note->get("tags") as $tag) {
                    // 取得該名稱的 tag
                    $new_tag = HackmdTag::where('name', $tag)->firstOrCreate(["name" => $tag]);

                    // 把屬於此份 note 的 tag id 丟進 array
                    $tag_ids[] = $new_tag->id;
                }
                // 加上 tag 關聯
                $old_note->tags()->attach($tag_ids);

                $count_update++;
            }

            DB::commit();

            $duration = round(microtime(true) - $start, 4);
            $message = sprintf('%s新增 %s 筆資料%s更新 %s 筆資料%s執行了 %s 秒%s', PHP_EOL, $count_create, PHP_EOL, $count_update, PHP_EOL, $duration, PHP_EOL);
            info($message);

            return $message;
        } catch (\Exception $err) {
            DB::rollback();
            info($err);

            return null;
        }
    }
}
