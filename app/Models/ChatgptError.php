<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatgptError extends Model
{
    use HasFactory;

    protected $fillable = [
        'sent_message',
        'message',
        'type',
        'param',
        'code',
    ];
}
