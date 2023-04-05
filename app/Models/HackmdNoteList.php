<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
