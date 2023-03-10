<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineBot extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'timestamp',
        'reply_token',
        'user_id',
        'event_source_id',
        'text',
    ];
}
