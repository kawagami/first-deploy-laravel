<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HackmdNote extends Model
{
    use HasFactory;

    protected $fillable = [
        "hackmd_note_id",
        "title",
        "createdAt",
        "publishType",
        "publishedAt",
        "permalink",
        "publishLink",
        "shortId",
        "content",
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
     * The tags that belong to the note.
     */
    public function tags()
    {
        return $this->belongsToMany(HackmdTag::class, "hackmd_note_tag", "note_id", "tag_id");
    }
}
