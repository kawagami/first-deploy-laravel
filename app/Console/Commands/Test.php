<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Hackmd\HackmdNoteListController;
use App\Http\Controllers\Hackmd\HackmdNoteController;
use App\Models\HackmdNote;
use App\Models\HackmdNoteList;
use App\Models\HackmdTag;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $note = HackmdNote::first();

        // // // dump(collect(get_class_methods($note->tags()))->sort());

        // // // foreach ($note->tags()->get() as $tag) {
        // // //     dump($tag->name);
        // // // }

        // $note_tags = $note->tags()->detach();

        // // dump($tags->toArray());

        // $tags = HackmdTag::get();
        // dump($tags);





        // return 0;

        // return $note;

        HackmdNoteListController::get_notes_list();
        return true;

        $note_id = '7B26GS5mT5-_kZ-dOcJKNg';
        // $note_id = '4894ag98wse498';
        HackmdNoteController::get_note($note_id);
        return true;

        // $note = json_decode(HackmdNoteController::get_note());
        // $now = now();
        // $insert_data = [
        //     "hackmd_note_id"  => data_get($note, "id"),
        //     "title"           => data_get($note, "title"),
        //     "tags"            => data_get($note, "tags"),
        //     "createdAt"       => data_get($note, "createdAt"),
        //     "publishType"     => data_get($note, "publishType"),
        //     "publishedAt"     => data_get($note, "publishedAt"),
        //     "permalink"       => data_get($note, "permalink"),
        //     "publishLink"     => data_get($note, "publishLink"),
        //     "shortId"         => data_get($note, "shortId"),
        //     "content"         => data_get($note, "content"),
        //     "lastChangedAt"   => data_get($note, "lastChangedAt"),
        //     "lastChangeUser"  => data_get($note, "lastChangeUser"),
        //     "userPath"        => data_get($note, "userPath"),
        //     "teamPath"        => data_get($note, "teamPath"),
        //     "readPermission"  => data_get($note, "readPermission"),
        //     "writePermission" => data_get($note, "writePermission"),
        //     "created_at"      => $now,
        //     "updated_at"      => $now,
        // ];
        // HackmdNote::create($insert_data);
        // return true;
    }
}
