<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class HackmdNoteList extends Model
{
    use HasFactory;

    protected $fillable = [
        "hackmd_note_lists_id",
        "title",
        "createdAt",
        "publishType",
        "publishedAt",
        "permalink",
        "publishLink",
        "shortId",
        "lastChangedAt",
        "lastChangeUser",
        "userPath",
        "teamPath",
        "readPermission",
        "writePermission",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'lastChangeUser' => Json::class,
    ];

    /**
     * The tags that belong to the note list.
     */
    public function tags()
    {
        return $this->belongsToMany(HackmdTag::class, "hackmd_note_list_tag", "note_list_id", "tag_id");
    }

    /**
     * trans createdAt to datetime string
     */
    protected function createdAt(): Attribute
    {
        // get 使用此 model 取 createdAt 資料時會將儲存的 int 值轉換成 datetime string
        return Attribute::make(
            get: fn (int $value) => Carbon::parse(($value / 1000))->toDateTimeString(),
        );
    }

    /**
     * trans lastChangedAt to datetime string
     */
    protected function lastChangedAt(): Attribute
    {
        // get 使用此 model 取 lastChangedAt 資料時會將儲存的 int 值轉換成 datetime string
        return Attribute::make(
            get: fn (int $value) => Carbon::parse(($value / 1000))->toDateTimeString(),
        );
    }
}
