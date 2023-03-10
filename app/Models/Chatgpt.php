<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatgpt extends Model
{
    use HasFactory;

    protected $fillable = [
        'sent_message',
        'data_id',
        'object',
        'created',
        'model',
        'usage_prompt_tokens',
        'usage_completion_tokens',
        'usage_total_tokens',
        'choices_message_role',
        'choices_message_content',
        'choices_finish_reason',
        'choices_index',
    ];
}
