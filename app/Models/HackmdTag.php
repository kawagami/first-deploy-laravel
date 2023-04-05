<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HackmdTag extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    /**
     * The note lists that belong to the tag.
     */
    public function noteLists()
    {
        return $this->belongsToMany(HackmdNoteList::class, "hackmd_note_list_tag", "tag_id", "note_list_id");
    }

    /**
     * The notes that belong to the tag.
     */
    public function notes()
    {
        return $this->belongsToMany(HackmdNote::class, "hackmd_note_tag", "tag_id", "note_id");
    }
}
