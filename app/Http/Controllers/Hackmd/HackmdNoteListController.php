<?php

namespace App\Http\Controllers\Hackmd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\HackmdNoteList;
use App\Models\HackmdTag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HackmdNoteListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $note_guest_can_read = HackmdNoteList::with('tags')
            ->where('readPermission', 'guest')
            ->orderByDesc('createdAt');

        // 過濾有"工作" tag 的筆記
        $note_guest_can_read->whereHas('tags', function ($query) {
            $query->where('name', '<>', '工作');
        });

        // 取得條件的 note
        if ($request->has('tag') && $request->get('tag') !== 'all') {
            $tag_id = $request->get('tag');
            $note_guest_can_read->whereHas('tags', function ($query) use ($tag_id) {
                $query->where(DB::raw('"hackmd_tags"."id"'), $tag_id);
            });
        }

        $notes = $note_guest_can_read->get();

        // 轉換日期
        $notes = $notes->map(function ($d) {
            $d->createdAt     = Carbon::parse(($d->createdAt / 1000))->toDateTimeString();
            $d->lastChangedAt = Carbon::parse(($d->lastChangedAt / 1000))->toDateTimeString();

            return $d;
        });

        return view('note', [
            'notes' => $notes,
            'tags'  => HackmdTag::get(),
        ]);
    }

    public static function get_notes_list(): string|null
    {
        // 統計資料
        $start = microtime(true);
        $count_create = 0;
        $count_update = 0;

        DB::beginTransaction();
        try {
            $url = 'https://api.hackmd.io/v1/notes';

            // 發出 request
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('HACKMD_TOKEN'),
            ])->get($url);

            // 200 以外報錯
            $response->throwUnlessStatus(200);

            // 整理資料
            $lists = $response->collect();
            // $insert_data = [];
            foreach ($lists as $key => $list) {
                $data = [
                    "hackmd_note_lists_id" => data_get($list, 'id'),
                    "title"                => data_get($list, 'title'),
                    // "tags"                 => json_encode(data_get($list, 'tags')),
                    "createdAt"            => data_get($list, 'createdAt'),
                    "publishType"          => data_get($list, 'publishType'),
                    "publishedAt"          => data_get($list, 'publishedAt'),
                    "permalink"            => data_get($list, 'permalink'),
                    "publishLink"          => data_get($list, 'publishLink'),
                    "shortId"              => data_get($list, 'shortId'),
                    "lastChangedAt"        => data_get($list, 'lastChangedAt'),
                    "lastChangeUser"       => data_get($list, 'lastChangeUser'),
                    "userPath"             => data_get($list, 'userPath'),
                    "teamPath"             => data_get($list, 'teamPath'),
                    "readPermission"       => data_get($list, 'readPermission'),
                    "writePermission"      => data_get($list, 'writePermission'),
                ];

                // 判斷是否有這筆資料
                $old_list = HackmdNoteList::where("hackmd_note_lists_id", data_get($list, 'id'))->first();

                // 沒有 note 資料的話新增
                if ($old_list === null) {
                    $new_note = HackmdNoteList::create($data);

                    // 處理 tags
                    $tag_ids = [];
                    foreach (data_get($list, 'tags') as $tag) {
                        // 取得該名稱的 tag
                        $new_tag = HackmdTag::where('name', $tag)->firstOrCreate(["name" => $tag]);

                        // 把屬於此份 note 的 tag id 丟進 array
                        $tag_ids[] = $new_tag->id;
                    }
                    // 加上 tag 關聯
                    $new_note->tags()->attach($tag_ids);

                    $count_create++;
                } elseif ($old_list->lastChangedAt < data_get($list, 'lastChangedAt')) {
                    // 更新資料
                    $old_list->update($data);

                    // 清掉 tags
                    $old_list->tags()->detach();

                    // 處理 tags
                    $tag_ids = [];
                    foreach (data_get($list, 'tags') as $tag) {
                        // 取得該名稱的 tag
                        $new_tag = HackmdTag::where('name', $tag)->firstOrCreate(["name" => $tag]);

                        // 把屬於此份 note 的 tag id 丟進 array
                        $tag_ids[] = $new_tag->id;
                    }
                    // 加上 tag 關聯
                    $old_list->tags()->attach($tag_ids);

                    $count_update++;
                }
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
